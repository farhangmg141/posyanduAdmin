<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPosyandu;
use App\Models\Posyandu;

class JadwalPosyanduController extends Controller
{
    // ==============================
    // INDEX (Pagination + Search + Filter)
    // ==============================
    public function index(Request $request)
    {
        // Ambil list posyandu untuk filter dropdown
        $posyanduList = Posyandu::all();

        // Query awal
        $query = JadwalPosyandu::with('posyandu');

        // FILTER: Posyandu
        if ($request->posyandu_id) {
            $query->where('posyandu_id', $request->posyandu_id);
        }

        // FILTER: Tanggal
        if ($request->tanggal) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // SEARCH: Tema / keterangan
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('tema', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('keterangan', 'LIKE', '%' . $request->search . '%');
            });
        }

        // Pagination
      $jadwal = $query->orderBy('tanggal', 'desc')->paginate(10);
    $jadwal->appends($request->all());


        return view('pages.jadwal_posyandu.index', compact('jadwal', 'posyanduList'));
    }

    // ==============================
    // CREATE
    // ==============================
    public function create()
    {
        $posyandu = Posyandu::all();
        return view('pages.jadwal_posyandu.create', compact('posyandu'));
    }

    // ==============================
    // STORE
    // ==============================
    public function store(Request $request)
    {
        $request->validate([
            'posyandu_id' => 'required',
            'tanggal'     => 'required|date',
            'tema'        => 'required|string',
            'keterangan'  => 'nullable|string',
        ]);

        JadwalPosyandu::create($request->all());

        return redirect()->route('jadwal.index')
                         ->with('success', 'Jadwal Posyandu berhasil ditambahkan.');
    }

    // ==============================
    // SHOW
    // ==============================
    public function show($id)
    {
        $jadwal = JadwalPosyandu::with('posyandu')->findOrFail($id);
        return view('pages.jadwal_posyandu.show', compact('jadwal'));
    }

    // ==============================
    // EDIT
    // ==============================
    public function edit($id)
    {
        $jadwal = JadwalPosyandu::findOrFail($id);
        $posyandu = Posyandu::all();

        return view('pages.jadwal_posyandu.edit', compact('jadwal', 'posyandu'));
    }

    // ==============================
    // UPDATE
    // ==============================
    public function update(Request $request, $id)
    {
        $request->validate([
            'posyandu_id' => 'required',
            'tanggal'     => 'required|date',
            'tema'        => 'required|string',
            'keterangan'  => 'nullable|string',
        ]);

        $jadwal = JadwalPosyandu::findOrFail($id);
        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')
                         ->with('success', 'Data Jadwal Posyandu berhasil diperbarui.');
    }

    // ==============================
    // DESTROY
    // ==============================
    public function destroy($id)
    {
        JadwalPosyandu::destroy($id);

        return redirect()->route('jadwal.index')
                         ->with('success', 'Data Jadwal Posyandu berhasil dihapus.');
    }
}
