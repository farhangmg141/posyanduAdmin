<?php

namespace App\Http\Controllers;

use App\Models\KaderPosyandu;
use App\Models\Warga;
use App\Models\Posyandu;
use Illuminate\Http\Request;

class KaderPosyanduController extends Controller
{
    public function index()
    {
        $data = KaderPosyandu::with(['warga', 'posyandu'])->get();
        return view('pages.kader_posyandu.index', compact('data'));
    }

    public function create()
    {
        $warga = Warga::all();
        $posyandu = Posyandu::all();
        return view('pages.kader_posyandu.create', compact('warga', 'posyandu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'posyandu_id' => 'required',
            'warga_id' => 'required',
            'peran' => 'required',
            'mulai_tugas' => 'required|date',
            'akhir_tugas' => 'nullable|date',
        ]);

        KaderPosyandu::create($request->all());
        return redirect()->route('kader.index')->with('success', 'Data kader berhasil ditambahkan');
    }

    public function edit(KaderPosyandu $kader_posyandu)
    {
        $warga = Warga::all();
        $posyandu = Posyandu::all();
        return view('pages.kader_posyandu.edit', compact('kader_posyandu', 'warga', 'posyandu'));
    }

    public function update(Request $request, KaderPosyandu $kader_posyandu)
    {
        $request->validate([
            'peran' => 'required',
            'mulai_tugas' => 'required|date',
        ]);

        $kader_posyandu->update($request->all());
        return redirect()->route('kader.index')->with('success', 'Data kader berhasil diperbarui');
    }

    public function destroy(KaderPosyandu $kader_posyandu)
    {
        $kader_posyandu->delete();
        return redirect()->route('kader.index')->with('success', 'Data kader berhasil dihapus');
    }

    public function show(KaderPosyandu $kader_posyandu)
    {
        return view('pages.kader_posyandu.show', compact('kader_posyandu'));
    }
}
