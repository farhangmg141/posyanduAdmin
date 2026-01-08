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
use App\Http\Controllers\CatatanImunisasiController;
use App\Http\Controllers\DokumentasiController;


/*
|--------------------------------------------------------------------------
| GUEST (LOGIN & REGISTER)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginRegister'])->name('login.show');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');

    Route::get('forgot-password', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [AuthController::class, 'updatePassword'])->name('password.update');
});


/*
|--------------------------------------------------------------------------
| AUTH PROTECTED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |-------------------------
    | LOGOUT
    |-------------------------
    */
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    /*
    |-------------------------
    | DASHBOARD
    |-------------------------
    */
     Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
     });


    /*
    |-------------------------
    | PROFIL ADMIN
    |-------------------------
    */
    Route::get('/admin/profil', [ProfilAdminController::class, 'index'])->name('profilAdmin.index');
    Route::get('/admin/profil/edit', [ProfilAdminController::class, 'edit'])->name('profilAdmin.edit');
    Route::post('/admin/profil/update', [ProfilAdminController::class, 'update'])->name('profilAdmin.update');


    /*
    |-------------------------
    | DOKUMENTASI (RESOURCE)
    |-------------------------
    */
  Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('dokumentasi', DokumentasiController::class);
});



    /*
    |-------------------------
    | LAYANAN POSYANDU (RESOURCE)
    |-------------------------
    */
    Route::resource('layanan', LayananPosyanduController::class);



    Route::prefix('admin')->group(function () {
        Route::get('/useradmin', [UserAdminController::class, 'index'])->name('useradmin.index');
        Route::get('/useradmin/create', [UserAdminController::class, 'create'])->name('useradmin.create');
        Route::post('/useradmin', [UserAdminController::class, 'store'])->name('useradmin.store');
        Route::get('/useradmin/{useradmin}/edit', [UserAdminController::class, 'edit'])->name('useradmin.edit');
        Route::put('/useradmin/{useradmin}', [UserAdminController::class, 'update'])->name('useradmin.update');
        Route::delete('/useradmin/{useradmin}', [UserAdminController::class, 'destroy'])->name('useradmin.destroy');
    });


    /*
    |-------------------------
    | DATA POSYANDU
    |-------------------------
    */
    Route::prefix('data')->group(function () {
        Route::get('/dataPosyandu', [DataPosyanduController::class, 'index'])->name('dataPosyandu.index');
        Route::get('/dataPosyandu/create', [DataPosyanduController::class, 'create'])->name('dataPosyandu.create');
        Route::post('/dataPosyandu', [DataPosyanduController::class, 'store'])->name('dataPosyandu.store');
        Route::get('/dataPosyandu/{posyandu}/edit', [DataPosyanduController::class, 'edit'])->name('dataPosyandu.edit');
        Route::put('/dataPosyandu/{posyandu}', [DataPosyanduController::class, 'update'])->name('dataPosyandu.update');
        Route::delete('/dataPosyandu/{posyandu}', [DataPosyanduController::class, 'destroy'])->name('dataPosyandu.destroy');
    });


    /*
    |-------------------------
    | WARGA
    |-------------------------
    */
    Route::prefix('warga')->group(function () {
        Route::get('/', [WargaController::class, 'index'])->name('warga.index');
        Route::get('/create', [WargaController::class, 'create'])->name('warga.create');
        Route::post('/', [WargaController::class, 'store'])->name('warga.store');
        Route::get('/{id}', [WargaController::class, 'show'])->name('warga.show');
        Route::get('/{id}/edit', [WargaController::class, 'edit'])->name('warga.edit');
        Route::put('/{id}', [WargaController::class, 'update'])->name('warga.update');
        Route::delete('/{id}', [WargaController::class, 'destroy'])->name('warga.destroy');

        Route::get('/export/excel', [WargaController::class, 'exportExcel'])->name('warga.export.excel');
        Route::get('/export/pdf', [WargaController::class, 'exportPdf'])->name('warga.export.pdf');
    });

    Route::get('/identitas-pengembang', function () {
    return view('identitas');
})->name('identitas.pengembang');

    /*
    |-------------------------
    | KADER POSYANDU (MANUAL, resource DIHAPUS)
    |-------------------------
    */
    Route::get('/kader-posyandu', [KaderPosyanduController::class, 'index'])->name('kader.index');
    Route::get('/kader-posyandu/create', [KaderPosyanduController::class, 'create'])->name('kader.create');
    Route::post('/kader-posyandu', [KaderPosyanduController::class, 'store'])->name('kader.store');
   Route::get('/kader-posyandu/{kader_posyandu}', [KaderPosyanduController::class, 'show'])->name('kader.show');
Route::get('/kader-posyandu/{kader_posyandu}/edit', [KaderPosyanduController::class, 'edit'])->name('kader.edit');
Route::put('/kader-posyandu/{kader_posyandu}', [KaderPosyanduController::class, 'update'])->name('kader.update');
Route::delete('/kader-posyandu/{kader_posyandu}', [KaderPosyanduController::class, 'destroy'])->name('kader.destroy');


    Route::get('/kader/export/excel', [KaderPosyanduController::class, 'exportExcel'])->name('kader.export.excel');
    Route::get('/kader/export/pdf', [KaderPosyanduController::class, 'exportPdf'])->name('kader.export.pdf');


    /*
    |-------------------------
    | JADWAL POSYANDU
    |-------------------------
    */
    Route::get('/jadwal-posyandu', [JadwalPosyanduController::class, 'index'])->name('jadwal.index');
    Route::get('/jadwal-posyandu/create', [JadwalPosyanduController::class, 'create'])->name('jadwal.create');
    Route::post('/jadwal-posyandu', [JadwalPosyanduController::class, 'store'])->name('jadwal.store');
    Route::get('/jadwal-posyandu/{id}', [JadwalPosyanduController::class, 'show'])->name('jadwal.show');
    Route::get('/jadwal-posyandu/{id}/edit', [JadwalPosyanduController::class, 'edit'])->name('jadwal.edit');
    Route::put('/jadwal-posyandu/{id}', [JadwalPosyanduController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwal-posyandu/{id}', [JadwalPosyanduController::class, 'destroy'])->name('jadwal.destroy');


    /*
    |-------------------------
    | CATATAN IMUNISASI
    |-------------------------
    */
    Route::prefix('admin/imunisasi')->group(function () {
        Route::get('/', [CatatanImunisasiController::class, 'index'])->name('imunisasi.index');
        Route::get('/create', [CatatanImunisasiController::class, 'create'])->name('imunisasi.create');
        Route::post('/store', [CatatanImunisasiController::class, 'store'])->name('imunisasi.store');
        Route::get('/edit/{id}', [CatatanImunisasiController::class, 'edit'])->name('imunisasi.edit');
        Route::put('/update/{id}', [CatatanImunisasiController::class, 'update'])->name('imunisasi.update');
        Route::delete('/delete/{id}', [CatatanImunisasiController::class, 'destroy'])->name('imunisasi.delete');
    });

});
