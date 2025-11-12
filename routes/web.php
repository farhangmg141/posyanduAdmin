<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataPosyanduController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KaderPosyanduController;
use App\Http\Controllers\JadwalPosyanduController;
use App\Http\Controllers\LayananPosyanduController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\ProfilAdminController;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginRegister'])->name('login.show');
    Route::get('/login', [AuthController::class, 'showLoginRegister'])->name('login'); // ✅ Tambahan ini
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');
    Route::get('forgot-password', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [AuthController::class, 'updatePassword'])->name('password.update');
});


Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // PROFIL ADMIN
    Route::get('/admin/profil', [ProfilAdminController::class, 'index'])->name('profilAdmin.index');
    Route::get('/admin/profil/edit', [ProfilAdminController::class, 'edit'])->name('profilAdmin.edit');
    Route::post('/admin/profil/update', [ProfilAdminController::class, 'update'])->name('profilAdmin.update');

    // USER ADMIN ROUTES
    Route::prefix('admin')->group(function () {
        Route::get('/useradmin', [UserAdminController::class, 'index'])->name('useradmin.index');
        Route::get('/useradmin/create', [UserAdminController::class, 'create'])->name('useradmin.create');
        Route::post('/useradmin', [UserAdminController::class, 'store'])->name('useradmin.store');
        Route::get('/useradmin/{useradmin}/edit', [UserAdminController::class, 'edit'])->name('useradmin.edit');
        Route::put('/useradmin/{useradmin}', [UserAdminController::class, 'update'])->name('useradmin.update');
        Route::delete('/useradmin/{useradmin}', [UserAdminController::class, 'destroy'])->name('useradmin.destroy');
    });

    // DATA POSYANDU
    Route::get('/data/dataPosyandu', [DataPosyanduController::class, 'index'])->name('dataPosyandu.index');
    Route::get('/data/dataPosyandu/create', [DataPosyanduController::class, 'create'])->name('dataPosyandu.create');
    Route::post('/data/dataPosyandu', [DataPosyanduController::class, 'store'])->name('dataPosyandu.store');
    Route::get('/data/dataPosyandu/{posyandu}/edit', [DataPosyanduController::class, 'edit'])->name('dataPosyandu.edit');
    Route::put('/data/dataPosyandu/{posyandu}', [DataPosyanduController::class, 'update'])->name('dataPosyandu.update');
    Route::delete('/data/dataPosyandu/{posyandu}', [DataPosyanduController::class, 'destroy'])->name('dataPosyandu.destroy');

    // WARGA ROUTES
    Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
    Route::get('/warga/create', [WargaController::class, 'create'])->name('warga.create');
    Route::post('/warga', [WargaController::class, 'store'])->name('warga.store');
    Route::get('/warga/{id}', [WargaController::class, 'show'])->name('warga.show');
    Route::get('/warga/{id}/edit', [WargaController::class, 'edit'])->name('warga.edit');
    Route::put('/warga/{id}', [WargaController::class, 'update'])->name('warga.update');
    Route::delete('/warga/{id}', [WargaController::class, 'destroy'])->name('warga.destroy');

    // KADER POSYANDU ROUTES
    Route::resource('kader-posyandu', KaderPosyanduController::class);
    Route::get('/kader-posyandu', [KaderPosyanduController::class, 'index'])->name('kader.index');
    Route::get('/kader-posyandu/create', [KaderPosyanduController::class, 'create'])->name('kader.create');
    Route::post('/kader-posyandu', [KaderPosyanduController::class, 'store'])->name('kader.store');
    Route::get('/kader-posyandu/{id}', [KaderPosyanduController::class, 'show'])->name('kader.show');
    Route::get('/kader-posyandu/{id}/edit', [KaderPosyanduController::class, 'edit'])->name('kader.edit');
    Route::put('/kader-posyandu/{id}', [KaderPosyanduController::class, 'update'])->name('kader.update');
    Route::delete('/kader-posyandu/{id}', [KaderPosyanduController::class, 'destroy'])->name('kader.destroy');

    // JADWAL POSYANDU ROUTES
    Route::get('/jadwal-posyandu', [JadwalPosyanduController::class, 'index'])->name('jadwal.index');
    Route::get('/jadwal-posyandu/create', [JadwalPosyanduController::class, 'create'])->name('jadwal.create');
    Route::post('/jadwal-posyandu', [JadwalPosyanduController::class, 'store'])->name('jadwal.store');
    Route::get('/jadwal-posyandu/{id}', [JadwalPosyanduController::class, 'show'])->name('jadwal.show');
    Route::get('/jadwal-posyandu/{id}/edit', [JadwalPosyanduController::class, 'edit'])->name('jadwal.edit');
    Route::put('/jadwal-posyandu/{id}', [JadwalPosyanduController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwal-posyandu/{id}', [JadwalPosyanduController::class, 'destroy'])->name('jadwal.destroy');

    // LAYANAN POSYANDU ROUTES
    Route::get('/layanan-posyandu', [LayananPosyanduController::class, 'index'])->name('layanan.index');
    Route::get('/layanan-posyandu/create', [LayananPosyanduController::class, 'create'])->name('layanan.create');
    Route::post('/layanan-posyandu', [LayananPosyanduController::class, 'store'])->name('layanan.store');
    Route::get('/layanan-posyandu/{id}', [LayananPosyanduController::class, 'show'])->name('layanan.show');
    Route::get('/layanan-posyandu/{id}/edit', [LayananPosyanduController::class, 'edit'])->name('layanan.edit');
    Route::put('/layanan-posyandu/{id}', [LayananPosyanduController::class, 'update'])->name('layanan.update');
    Route::delete('/layanan-posyandu/{id}', [LayananPosyanduController::class, 'destroy'])->name('layanan.destroy');
});
