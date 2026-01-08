<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LayananPosyandu;
use App\Models\JadwalPosyandu;
use App\Models\Warga;

class LayananPosyanduController extends Controller
{
    public function index(Request $request)
    {
        $query = LayananPosyandu::with(['jadwal', 'warga']);

        // SEARCH
        if ($request->search) {
            $query->whereHas('warga', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            })
            ->orWhere('vitamin', 'like', '%' . $request->search . '%')
            ->orWhere('konseling', 'like', '%' . $request->search . '%');
        }

        // FILTER JADWAL
        if ($request->jadwal_id) {
            $query->where('jadwal_id', $request->jadwal_id);
        }

        // FILTER WARGA
        if ($request->warga_id) {
            $query->where('warga_id', $request->warga_id);
        }

        // PAGINATION
        $layanan = $query->paginate(10);
        $layanan->appends($request->all());

        $jadwal = JadwalPosyandu::all();
        $warga = Warga::all();

        return view('pages.layanan.index', compact('layanan', 'jadwal', 'warga'));
    }

    public function create()
    {
        $jadwal = JadwalPosyandu::all();
        $warga = Warga::all();
        return view('pages.layanan.create', compact('jadwal', 'warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required',
            'warga_id' => 'required',
        ]);

        LayananPosyandu::create($request->all());

        return redirect()->route('layanan.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function show($id)
    {
        $item = LayananPosyandu::with(['jadwal', 'warga'])->findOrFail($id);
        return view('pages.layanan.show', compact('item'));
    }

    public function edit($id)
    {
        $item = LayananPosyandu::findOrFail($id);
        $jadwal = JadwalPosyandu::all();
        $warga = Warga::all();
        return view('pages.layanan.edit', compact('item', 'jadwal', 'warga'));
    }

    public function update(Request $request, $id)
    {
        $item = LayananPosyandu::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('layanan.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        LayananPosyandu::destroy($id);
        return redirect()->route('layanan.index')->with('success', 'Data berhasil dihapus');
    }
}
