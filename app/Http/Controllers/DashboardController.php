<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use App\Models\KaderPosyandu;
use App\Models\JadwalPosyandu;
use App\Models\LayananPosyandu;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data ringkasan
        $totalPosyandu   = Posyandu::count();
        $totalKader      = KaderPosyandu::count();
        $totalJadwal     = JadwalPosyandu::count();
        $totalLayanan    = LayananPosyandu::count();

        // Ambil 5 data terbaru dari masing-masing tabel
        $dataPosyandu    = Posyandu::latest()->take(5)->get();
        $dataKader       = KaderPosyandu::with(['posyandu', 'warga'])->latest()->take(5)->get();
        $dataJadwal      = JadwalPosyandu::with('posyandu')->latest()->take(5)->get();
        $dataLayanan     = LayananPosyandu::with(['jadwal', 'warga'])->latest()->take(5)->get();

        return view('pages.dashboard.dashboard', compact(
            'totalPosyandu',
            'totalKader',
            'totalJadwal',
            'totalLayanan',
            'dataPosyandu',
            'dataKader',
            'dataJadwal',
            'dataLayanan'
        ));
    }
}
