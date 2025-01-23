<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\VerifikasiEmailUntukRegistrasiPengaduanMasyarakat;
use App\Models\Masyarakat;
use App\Models\Pengaduan;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::count();
        $proses = Pengaduan::where('status', 'proses')->count();
        $selesai = Pengaduan::where('status', 'selesai')->count();

        return view('home', [
            'pengaduan' => $pengaduan,
            'proses' => $proses,
            'selesai' => $selesai,
        ]);
    }

    // public function tentang()
    // {
    //     return view('pages.user.about');
    // }

    public function pengaduan()
    {
        $pengaduan = Pengaduan::get();
        return view('pages.user.pengaduan', compact('pengaduan'));
    }

    public function masuk()
    {
        return view('pages.user.login');
    }

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $credentials = filter_var($request->username, FILTER_VALIDATE_EMAIL)
            ? ['email' => $request->username, 'password' => $request->password]
            : ['username' => $request->username, 'password' => $request->password];

        if (Auth::guard('masyarakat')->attempt($credentials)) {
            return redirect()->route('pengaduan');
        }

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar atau password salah!']);
    }
    public function register()
    {
        return view('pages.user.register');
    }

    public function register_post(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nik'       => 'required|digits:16|unique:masyarakat',
            'name'      => 'required|string',
            'email'     => 'required|email|unique:masyarakat',
            'username'  => 'required|string|alpha_dash|unique:masyarakat|unique:petugas',
            'password'  => 'required|string|min:6|confirmed',
            'telp'      => 'required|regex:/^08[0-9]{8,11}$/',
        ]);
    
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
    
        // Pastikan password di-hash sebelum disimpan
        $masyarakat = new Masyarakat();
        $masyarakat->nik = $request->nik;
        $masyarakat->name = $request->name;
        $masyarakat->email = $request->email;
        $masyarakat->username = $request->username;
        $masyarakat->password = Hash::make($request->password); // Pastikan ini berjalan
        $masyarakat->telp = $request->telp;
        $masyarakat->save();
    
        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }
    

    public function logout()
    {
        Auth::guard('masyarakat')->logout();

        return redirect('/login');
    }

    public function storePengaduan(Request $request)
    {
        $data = $request->validate([
            'judul_laporan'   => 'required|string',
            'isi_laporan'     => 'required|string',
            'tgl_kejadian'    => 'required|date',
            'lokasi_kejadian' => 'required|string',
        ]);

        if (!Auth::guard('masyarakat')->check()) {
            return back()->with(['pengaduan' => 'Login dibutuhkan!', 'type' => 'error']);
        }

        if (is_null(Auth::guard('masyarakat')->user()->email_verified_at)) {
            return back()->with(['pengaduan' => 'Akun belum diverifikasi!', 'type' => 'error']);
        }

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('assets/pengaduan', 'public');
        } else {
            $data['foto'] = 'assets/pengaduan/tambakmekar.png';
        }

        Pengaduan::create([
            'tgl_pengaduan'   => Carbon::now(),
            'nik'             => Auth::guard('masyarakat')->user()->nik,
        ] + $data + ['status' => '0']);

        return back()->with(['pengaduan' => 'Berhasil terkirim!', 'type' => 'success']);
    }

    public function laporan($who = '')
    {
        $terverifikasi = Pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', '!=', '0']])->get()->count();
        $proses = Pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', 'proses']])->get()->count();
        $selesai = Pengaduan::where([['nik', Auth::guard('masyarakat')->user()->nik], ['status', 'selesai']])->get()->count();

        $hitung = [$terverifikasi, $proses, $selesai];

        if ($who == 'saya') {

            $pengaduan = Pengaduan::where('nik', Auth::guard('masyarakat')->user()->nik)->orderBy('tgl_pengaduan', 'desc')->get();

            return view('pages.user.laporan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'who' => $who]);
        } else {

            $pengaduan = Pengaduan::where('status', '!=', '0')->orderBy('tgl_pengaduan', 'desc')->get();

            return view('pages.user.laporan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'who' => $who]);
        }
    }

    public function detailPengaduan($id_pengaduan)
    {
        $pengaduan = Pengaduan::where('id_pengaduan', $id_pengaduan)->first();

        return view('pages.user.detail', ['pengaduan' => $pengaduan]);
    }

    public function laporanEdit($id_pengaduan)
    {
        $pengaduan = Pengaduan::where('id_pengaduan', $id_pengaduan)->first();

        return view('user.edit', ['pengaduan' => $pengaduan]);
    }

    public function laporanUpdate(Request $request, $id_pengaduan)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'judul_laporan' => ['required'],
            'isi_laporan' => ['required'],
            'tgl_kejadian' => ['required'],
            'lokasi_kejadian' => ['required'],
            // 'id_kategori' => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        if ($request->file('foto')) {
            $data['foto'] = $request->file('foto')->store('assets/pengaduan', 'public');
        }

        $pengaduan = Pengaduan::where('id_pengaduan', $id_pengaduan)->first();

        $pengaduan->update([
            'judul_laporan' => $data['judul_laporan'],
            'isi_laporan' => $data['isi_laporan'],
            'tgl_kejadian' => $data['tgl_kejadian'],
            'lokasi_kejadian' => $data['lokasi_kejadian'],
            // 'id_kategori' => $data['kategori_kejadian'],
            'foto' => $data['foto'] ?? $pengaduan->foto
        ]);

        return redirect()->route('pekat.detail', $id_pengaduan);
    }

    public function laporanDestroy(Request $request)
    {
        $pengaduan = Pengaduan::where('id_pengaduan', $request->id_pengaduan)->first();

        $pengaduan->delete();

        return 'success';
    }


    public function password()
    {
        return view('user.password');
    }

    public function updatePassword(Request $request)
    {
        $data = $request->all();

        if (Auth::guard('masyarakat')->user()->password == null) {
            $validate = Validator::make($data, [
                'password' => ['required', 'min:6', 'confirmed'],
            ]);
        } else {
            $validate = Validator::make($data, [
                'old_password' => ['required', 'min:6'],
                'password' => ['required', 'min:6', 'confirmed'],
            ]);
        }

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        $nik = Auth::guard('masyarakat')->user()->nik;

        $masyarakat = Masyarakat::where('nik', $nik)->first();

        if (Auth::guard('masyarakat')->user()->password == null) {
            $masyarakat->password = Hash::make($data['password']);
            $masyarakat->save();

            return redirect()->back()->with(['pesan' => 'Password berhasil diubah!', 'type' => 'success']);
        } elseif (Hash::check($data['old_password'], $masyarakat->password)) {

            $masyarakat->password = Hash::make($data['password']);
            $masyarakat->save();

            return redirect()->back()->with(['pesan' => 'Password berhasil diubah!', 'type' => 'success']);
        } else {
            return redirect()->back()->with(['pesan' => 'Password lama salah!', 'type' => 'error']);
        }
    }

    public function ubah(Request $request, $what)
    {
        if ($what == 'email') {
            $masyarakat = Masyarakat::where('nik', $request->nik)->first();

            $masyarakat->email = $request->email;
            $masyarakat->save();

            return 'success';
        } elseif ($what == 'telp') {

            $validate = Validator::make($request->all(), [
                'telp' => ['required', 'regex:/(08)[0-9]/'],
            ]);

            if ($validate->fails()) {
                return 'error';
            }

            $masyarakat = Masyarakat::where('nik', $request->nik)->first();

            $masyarakat->telp = $request->telp;
            $masyarakat->save();

            return 'success';
        }
    }

    public function profil()
    {
        $nik = Auth::guard('masyarakat')->user()->nik;

        $masyarakat = Masyarakat::where('nik', $nik)->first();

        return view('user.profil', ['masyarakat' => $masyarakat]);
    }

    public function updateProfil(Request $request)
    {
        $nik = Auth::guard('masyarakat')->user()->nik;

        $data = $request->all();

        $validate = Validator::make($data, [
            'nik' => ['sometimes', 'required', 'min:16', 'max:16', Rule::unique('masyarakat')->ignore($nik, 'nik')],
            'nama' => ['required', 'string'],
            'email' => ['sometimes', 'required', 'email', 'string', Rule::unique('masyarakat')->ignore($nik, 'nik')],
            'username' => ['sometimes', 'required', 'string', 'regex:/^\S*$/u', Rule::unique('masyarakat')->ignore($nik, 'nik'), 'unique:petugas,username'],
            'telp' => ['required', 'regex:/(08)[0-9]/'],
            'alamat' => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        $masyarakat = Masyarakat::where('nik', $nik);

        $masyarakat->update([
            'nik' => $data['nik'],
            'nama' => $data['nama'],
            'email' => $data['email'],
            'username' => strtolower($data['username']),
            'telp' => $data['telp'],
        ]);
        return redirect()->back()->with(['pesan' => 'Profil berhasil diubah!', 'type' => 'success']);
    }
}