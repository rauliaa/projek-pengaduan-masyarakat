<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\MasyarakatController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PengaduanController;
use App\Http\Controllers\Admin\TanggapanController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index']);

Route::get('/pengaduan', [UserController::class, 'pengaduan'])->name('pengaduan');
Route::post('/pengaduan/kirim', [UserController::class, 'storePengaduan'])->name('pengaduan.store');
Route::get('/tentang', [UserController::class, 'tentang']);

// Guest Routes
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [UserController::class, 'masuk'])->name('user.masuk');
    Route::post('/login/auth', [UserController::class, 'login'])->name('user.login');
    Route::get('/register', [UserController::class, 'register'])->name('user.register');
    Route::post('/register/auth', [UserController::class, 'register_post'])->name('user.register-post');
});

Route::middleware(['isMasyarakat'])->group(function () {
     Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
     Route::get('/laporan/{who?}', [UserController::class, 'laporan'])->name('pengaduan.laporan');
     Route::get('/pengaduan-detail/{id_pengaduan}', [UserController::class, 'detailPengaduan'])->name('pengaduan.detail');
});

Route::prefix('admin')->group(function () {
    // Admin Routes (Only accessible by isAdmin)
    Route::middleware('isAdmin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/petugas', PetugasController::class);
        Route::resource('/masyarakat', MasyarakatController::class);
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::post('/laporan-get', [LaporanController::class, 'laporan'])->name('laporan.get');
        Route::post('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');
        Route::get('pengaduan/{status}', [PengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('pengaduan/show/{id_pengaduan}', [PengaduanController::class, 'show'])->name('pengaduan.show');
        Route::delete('pengaduan/delete/{id_pengaduan}', [PengaduanController::class, 'destroy'])->name('pengaduan.delete');
        Route::post('tanggapan', [TanggapanController::class, 'response'])->name('tanggapan');
    });

    Route::prefix('admin')->group( function() {
        Route::middleware('isAdmin')->group( function() {
           Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
           Route::resource('/petugas', \App\Http\Controllers\Admin\PetugasController::class);
           Route::resource('/masyarakat', \App\Http\Controllers\Admin\MasyarakatController::class);
    
           Route::get('/laporan', [\App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('laporan.index');
           Route::post('/laporan-get', [\App\Http\Controllers\Admin\LaporanController::class, 'laporan'])->name('laporan.get');
           Route::post('/laporan/export', [\App\Http\Controllers\Admin\LaporanController::class, 'export'])->name('laporan.export');
        });
    
        Route::middleware('isPetugas')->group( function() {
            Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
            Route::get('/logout', [\App\Http\Controllers\Admin\AdminController::class, 'logout'])->name('admin.logout');
    
            // Pengaduan
            Route::get('pengaduan/{status}', [\App\Http\Controllers\Admin\PengaduanController::class, 'index'])->name('pengaduan.index');
            Route::get('pengaduan/show/{id_pengaduan}', [\App\Http\Controllers\Admin\PengaduanController::class, 'show'])->name('pengaduan.show');
            Route::delete('pengaduan/delete/{id_pengaduan}', [\App\Http\Controllers\Admin\PengaduanController::class, 'destroy'])->name('pengaduan.delete');
    
            // Tanggapan
            Route::post('tanggapan', [\App\Http\Controllers\Admin\TanggapanController::class, 'response'])->name('tanggapan');
    
         });
    
    
        Route::middleware(['isGuest'])->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'formLogin'])->name('admin.masuk');
            Route::post('/login', [\App\Http\Controllers\Admin\AdminController::class, 'login'])->name('admin.login');
        });
    });
    // Guest Routes for Admin (Accessible only if not logged in)
    Route::middleware(['isGuest'])->group(function () {
        Route::get('/', [AdminController::class, 'formLogin'])->name('admin.masuk');
        Route::post('/login', [AdminController::class, 'login'])->name('admin.login');
    });

});
