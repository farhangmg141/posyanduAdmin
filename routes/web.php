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

Route::prefix('admin')->group(function () {
    Route::get('/useradmin', [UserAdminController::class, 'index'])->name('useradmin.index');
    Route::get('/useradmin/create', [UserAdminController::class, 'create'])->name('useradmin.create');
    Route::post('/useradmin', [UserAdminController::class, 'store'])->name('useradmin.store');
    Route::get('/useradmin/{useradmin}/edit', [UserAdminController::class, 'edit'])->name('useradmin.edit');
    Route::put('/useradmin/{useradmin}', [UserAdminController::class, 'update'])->name('useradmin.update');
    Route::delete('/useradmin/{useradmin}', [UserAdminController::class, 'destroy'])->name('useradmin.destroy');
});



// Proses Login
Route::get('/', [AuthController::class, 'showLoginRegister'])->name('login.show')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
// Proses Register
Route::post('/register', [AuthController::class, 'register'])->name('register.process');
Route::get('forgot-password', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [AuthController::class, 'updatePassword'])->name('password.update');


// Dashboard (setelah login)
Route::get('/login', [AuthController::class, 'showLoginRegister'])->name('login.show')->middleware('guest');
// Dashboard Admin
Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// routes/web.php
Route::get('/data/dataPosyandu', [DataPosyanduController::class, 'index'])->name('dataPosyandu.index');
Route::get('/data/dataPosyandu/create', [DataPosyanduController::class, 'create'])->name('dataPosyandu.create');
Route::post('/data/dataPosyandu', [DataPosyanduController::class, 'store'])->name('dataPosyandu.store');

// ubah parameter ke {posyandu}
Route::get('/data/dataPosyandu/{posyandu}/edit', [DataPosyanduController::class, 'edit'])
    ->name('dataPosyandu.edit');
Route::put('/data/dataPosyandu/{posyandu}', [DataPosyanduController::class, 'update'])->name('dataPosyandu.update');
Route::delete('/data/dataPosyandu/{posyandu}', [DataPosyanduController::class, 'destroy'])
    ->name('dataPosyandu.destroy');




// ROUTES WARGA
Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
Route::get('/warga/create', [WargaController::class, 'create'])->name('warga.create');
Route::post('/warga', [WargaController::class, 'store'])->name('warga.store');
Route::get('/warga/{id}', [WargaController::class, 'show'])->name('warga.show');
Route::get('/warga/{id}/edit', [WargaController::class, 'edit'])->name('warga.edit');
Route::put('/warga/{id}', [WargaController::class, 'update'])->name('warga.update');
Route::delete('/warga/{id}', [WargaController::class, 'destroy'])->name('warga.destroy');




Route::resource('kader-posyandu', KaderPosyanduController::class);
// Menampilkan semua kader
Route::get('/kader-posyandu', [KaderPosyanduController::class, 'index'])->name('kader.index');
// Menampilkan form tambah kader
Route::get('/kader-posyandu/create', [KaderPosyanduController::class, 'create'])->name('kader.create');
// Proses simpan kader baru
Route::post('/kader-posyandu', [KaderPosyanduController::class, 'store'])->name('kader.store');
// Menampilka detail 1 kader
Route::get('/kader-posyandu/{id}', [KaderPosyanduController::class, 'show'])->name('kader.show');
// Menampilkan form edit kader
Route::get('/kader-posyandu/{id}/edit', [KaderPosyanduController::class, 'edit'])->name('kader.edit');
// Proses update data kader
Route::put('/kader-posyandu/{id}', [KaderPosyanduController::class, 'update'])->name('kader.update');
// Hapus data kader
Route::delete('/kader-posyandu/{id}', [KaderPosyanduController::class, 'destroy'])->name('kader.destroy');


// ROUTES JADWAL POSYANDU
Route::get('/jadwal-posyandu', [JadwalPosyanduController::class, 'index'])->name('jadwal.index');
Route::get('/jadwal-posyandu/create', [JadwalPosyanduController::class, 'create'])->name('jadwal.create');
Route::post('/jadwal-posyandu', [JadwalPosyanduController::class, 'store'])->name('jadwal.store');
Route::get('/jadwal-posyandu/{id}', [JadwalPosyanduController::class, 'show'])->name('jadwal.show');
Route::get('/jadwal-posyandu/{id}/edit', [JadwalPosyanduController::class, 'edit'])->name('jadwal.edit');
Route::put('/jadwal-posyandu/{id}', [JadwalPosyanduController::class, 'update'])->name('jadwal.update');
Route::delete('/jadwal-posyandu/{id}', [JadwalPosyanduController::class, 'destroy'])->name('jadwal.destroy');


// ROUTES LAYANAN POSYANDU
Route::get('/layanan-posyandu', [LayananPosyanduController::class, 'index'])->name('layanan.index');
Route::get('/layanan-posyandu/create', [LayananPosyanduController::class, 'create'])->name('layanan.create');
Route::post('/layanan-posyandu', [LayananPosyanduController::class, 'store'])->name('layanan.store');
Route::get('/layanan-posyandu/{id}', [LayananPosyanduController::class, 'show'])->name('layanan.show');
Route::get('/layanan-posyandu/{id}/edit', [LayananPosyanduController::class, 'edit'])->name('layanan.edit');
Route::put('/layanan-posyandu/{id}', [LayananPosyanduController::class, 'update'])->name('layanan.update');
Route::delete('/layanan-posyandu/{id}', [LayananPosyanduController::class, 'destroy'])->name('layanan.destroy');
