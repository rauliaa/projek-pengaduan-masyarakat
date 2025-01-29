<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\MasyarakatController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PengaduanController;
use App\Http\Controllers\Admin\TanggapanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UserController::class, 'index']);

Route::get('/pengaduan',  [UserController::class, 'pengaduan'])->name('pengaduan');
Route::post('/pengaduan/kirim',  [UserController::class, 'storePengaduan'])->name('pengaduan.store');

Route::get('/login',  [UserController::class, 'masuk']);
Route::get('/register',  [UserController::class, 'daftar']);
Route::get('/tentang',  [UserController::class, 'tentang']);

Route::middleware(['guest'])->group(function () {
    // Login Masyarakat
    Route::get('/login',  [UserController::class, 'masuk'])->name('user.masuk');
    Route::post('/login/auth', [UserController::class, 'login'])->name('user.login');

    // Register
    Route::get('/register', [UserController::class, 'register'])->name('user.register');
    Route::post('/register/auth', [UserController::class, 'register_post'])->name('user.register-post');
});

Route::middleware(['isMasyarakat'])->group(function () {
     // Logout Masyarakat
     Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');


     Route::get('/laporan/{who?}', [UserController::class, 'laporan'])->name('pengaduan.laporan');
     Route::get('/pengaduan-detail/{id_pengaduan}', [UserController::class, 'detailPengaduan'])->name('pengaduan.detail');
});


Route::prefix('admin')->group( function() {
    Route::middleware('isAdmin')->group( function() {
       Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

       Route::resource('/petugas', PetugasController::class);
       Route::resource('/masyarakat', MasyarakatController::class);

       Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
       Route::post('/laporan-get', [LaporanController::class, 'laporan'])->name('laporan.get');
       Route::post('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');
    });

    Route::middleware('isPetugas')->group( function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

        // Pengaduan
        Route::get('pengaduan/{status}', [PengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('pengaduan/show/{id_pengaduan}', [PengaduanController::class, 'show'])->name('pengaduan.show');
        Route::delete('pengaduan/delete/{id_pengaduan}', [PengaduanController::class, 'destroy'])->name('pengaduan.delete');

        // Tanggapan
        Route::post('tanggapan', [TanggapanController::class, 'response'])->name('tanggapan');

     });


    Route::middleware(['isGuest'])->group(function () {
        Route::get('/', [AdminController::class, 'formLogin'])->name('admin.masuk');
        Route::post('/login', [AdminController::class, 'login'])->name('admin.login');
    });
});
