<?php

use App\Http\Controllers\PosyanduController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/posyandu', [PosyanduController::class, 'index'])->name('posyandu.index');
