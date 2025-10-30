<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPosyandu;
use App\Models\Posyandu;

class JadwalPosyanduController extends Controller
{
    public function index()
    {
        $jadwal = JadwalPosyandu::with('posyandu')->get();
        return view('jadwal_posyandu.index', compact('jadwal'));
    }

    public function create()
    {
        $posyandu = \App\Models\Posyandu::all();
        return view('jadwal_posyandu.create', compact('posyandu'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'posyandu_id' => 'required',
            'tanggal' => 'required|date',
            'tema' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        JadwalPosyandu::create($data);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal Posyandu berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $jadwal = JadwalPosyandu::findOrFail($id);
        $posyandu = Posyandu::all();
        return view('jadwal_posyandu.edit', compact('jadwal', 'posyandu'));
    }
    public function show($id)
    {

        $jadwal = \App\Models\JadwalPosyandu::with('posyandu')->findOrFail($id);


        return view('jadwal_posyandu.show', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'posyandu_id' => 'required',
            'tanggal' => 'required|date',
            'tema' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $jadwal = JadwalPosyandu::findOrFail($id);
        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Data Jadwal Posyandu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        JadwalPosyandu::destroy($id);
        return redirect()->route('jadwal.index')->with('success', 'Data Jadwal Posyandu berhasil dihapus.');
    }
}
