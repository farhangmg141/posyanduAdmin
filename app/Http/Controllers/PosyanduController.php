<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PosyanduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $dataPosyandu = [
            ['nama' => 'Ani', 'nik' => '3276010101010001', 'usia' => 3, 'kategori' => 'Balita', 'alamat' => 'Bandung'],
            ['nama' => 'Budi', 'nik' => '3276010101010002', 'usia' => 2, 'kategori' => 'Balita', 'alamat' => 'Jakarta'],
            ['nama' => 'Citra', 'nik' => '3276010101010003', 'usia' => 1, 'kategori' => 'Balita', 'alamat' => 'Surabaya'],
            ['nama' => 'Dewi', 'nik' => '3276010101010004', 'usia' => 28, 'kategori' => 'Ibu Hamil', 'alamat' => 'Bandung'],
            ['nama' => 'Eka', 'nik' => '3276010101010005', 'usia' => 30, 'kategori' => 'Ibu Hamil', 'alamat' => 'Jakarta'],
            ['nama' => 'Fajar', 'nik' => '3276010101010006', 'usia' => 4, 'kategori' => 'Balita', 'alamat' => 'Bandung'],
            ['nama' => 'Gita', 'nik' => '3276010101010007', 'usia' => 29, 'kategori' => 'Ibu Hamil', 'alamat' => 'Surabaya'],
            ['nama' => 'Hani', 'nik' => '3276010101010008', 'usia' => 2, 'kategori' => 'Balita', 'alamat' => 'Bandung'],
            ['nama' => 'Indra', 'nik' => '3276010101010009', 'usia' => 1, 'kategori' => 'Balita', 'alamat' => 'Jakarta'],
            ['nama' => 'Joko', 'nik' => '3276010101010010', 'usia' => 3, 'kategori' => 'Balita', 'alamat' => 'Surabaya'],
        ];

        return view('posyandu.index', compact('dataPosyandu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
