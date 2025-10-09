<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

// Halaman login
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');

// Proses login
Route::post('/login', [LoginController::class, 'processLogin'])->name('login.process');

// Proses register
Route::post('/register', [LoginController::class, 'processRegister'])->name('register.process');

// Dashboard (setelah login)
Route::get('/dashboard', function () {
    return view('dashboard'); // Ganti 'index' dengan nama view dashboard kamu
})->middleware('auth')->name('dashboard');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



// Route::get('/posyandu', [PosyanduController::class, 'index'])->name('posyandu.index');
// Route::get('/posyanduLogin', [PosyanduController::class, 'index'])->name('posyandu.index');
