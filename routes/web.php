<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataPosyanduController;
use App\Http\Controllers\AuthController;



// Proses Login
Route::get('/login', [AuthController::class, 'showLoginRegister'])->name('login.show')->middleware('guest');
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

// Halaman Data Posyandu
// Menampilkan semua data posyandu
Route::get('/data/dataPosyandu', [DataPosyanduController::class, 'index'])->name('dataPosyandu.index');
// Form tambah posyandu
Route::get('/data/dataPosyandu/create', [DataPosyanduController::class, 'create'])->name('dataPosyandu.create');
// Simpan data baru
Route::post('/data/dataPosyandu', [DataPosyanduController::class, 'store'])->name('dataPosyandu.store');
// Form edit posyandu
Route::get('/data/dataPosyandu/{id}/edit', [DataPosyanduController::class, 'edit'])->name('dataPosyandu.edit');
// Update data
Route::put('/data/dataPosyandu/{id}', [DataPosyanduController::class, 'update'])->name('dataPosyandu.update');
// Hapus data
Route::delete('/data/dataPosyandu/{id}', [DataPosyanduController::class, 'destroy'])->name('dataPosyandu.destroy');
