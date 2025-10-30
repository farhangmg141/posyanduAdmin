<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LayananPosyandu;
use App\Models\JadwalPosyandu;
use App\Models\Warga;

class LayananPosyanduController extends Controller
{
    public function index()
    {
        $layanan = LayananPosyandu::with(['jadwal', 'warga'])->get();
        return view('layanan_posyandu.index', compact('layanan'));
    }

    public function create()
    {
        $jadwal = JadwalPosyandu::all();
        $warga = Warga::all();
        return view('layanan_posyandu.create', compact('jadwal', 'warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required',
            'warga_id' => 'required',
            'berat' => 'required|numeric',
            'tinggi' => 'required|numeric',
            'vitamin' => 'nullable|string',
            'konseling' => 'nullable|string',
        ]);

        LayananPosyandu::create($request->all());
        return redirect()->route('layanan.index')->with('success', 'Layanan Posyandu berhasil ditambahkan.');
    }

    public function show($id)
    {
        $layanan = LayananPosyandu::with(['jadwal', 'warga'])->findOrFail($id);
        return view('layanan_posyandu.show', compact('layanan'));
    }

    public function edit($id)
    {
        $layanan = LayananPosyandu::findOrFail($id);
        $jadwal = JadwalPosyandu::all();
        $warga = Warga::all();
        return view('layanan_posyandu.edit', compact('layanan', 'jadwal', 'warga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jadwal_id' => 'required',
            'warga_id' => 'required',
            'berat' => 'required|numeric',
            'tinggi' => 'required|numeric',
            'vitamin' => 'nullable|string',
            'konseling' => 'nullable|string',
        ]);

        $layanan = LayananPosyandu::findOrFail($id);
        $layanan->update($request->all());

        return redirect()->route('layanan.index')->with('success', 'Data Layanan Posyandu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        LayananPosyandu::destroy($id);
        return redirect()->route('layanan.index')->with('success', 'Data Layanan Posyandu berhasil dihapus.');
    }
}
