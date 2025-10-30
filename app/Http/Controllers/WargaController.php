<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index()
    {
        $data = Warga::all();
        return view('warga.index', compact('data'));
    }

    public function create()
    {
        return view('warga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'nik' => 'required|numeric|unique:warga',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'nullable|date',
        ]);

        Warga::create($request->all());
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan');
    }

  public function edit($id)
{
    $warga = Warga::findOrFail($id);
    return view('warga.edit', compact('warga'));
}


    public function update(Request $request, $id)
{
    $request->validate([
        'nama'   => 'required|string|max:255',
        'alamat' => 'required|string',
    ]);

    $warga = Warga::findOrFail($id);
    $warga->update([
        'nama'   => $request->nama,
        'alamat' => $request->alamat,
        // tambahkan field lain sesuai tabel kamu
    ]);

    return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui!');
}


    public function destroy($id)
{
    $warga = Warga::findOrFail($id);
    $warga->delete();

    return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus!');
}


    public function show($id)
{
    $warga = \App\Models\Warga::findOrFail($id);
    return view('warga.show', compact('warga'));
}

}
