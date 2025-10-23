<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Posyandu; 
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua data posyandu
        $dataPosyandu = Posyandu::latest()->get();

        // Hitung jumlah posyandu
        $totalPosyandu = $dataPosyandu->count();

        return view('admin.dashboard', compact('dataPosyandu', 'totalPosyandu'));
    }
}
