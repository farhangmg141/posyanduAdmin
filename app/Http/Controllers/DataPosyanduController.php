<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataPosyanduController extends Controller
{
    public function index()
    {
        $data = Posyandu::latest()->get();
        return view('admin.dataPosyandu.index', compact('data'));
    }

    public function create()
    {
        return view('admin.dataPosyandu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required',
            'rt' => 'required|max:5',
            'rw' => 'required|max:5',
            'kontak' => 'nullable|string|max:255',
            'media' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->hasFile('media')
            ? $request->file('media')->store('posyandu', 'public')
            : null;

        Posyandu::create($request->only(['nama', 'alamat', 'rt', 'rw', 'kontak']) + ['media' => $path]);

        return redirect()->route('dataPosyandu.index')->with('success', 'Data berhasil ditambahkan!');
    }

  // app/Http/Controllers/DataPosyanduController.php
public function edit($id)
{
    $posyandu = Posyandu::findOrFail($id);
    return view('admin.dataPosyandu.edit', compact('posyandu'));
}


public function update(Request $request, Posyandu $posyandu)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required',
        'rt' => 'required|max:5',
        'rw' => 'required|max:5',
        'kontak' => 'nullable|string|max:255',
        'media' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $path = $posyandu->media;
    if ($request->hasFile('media')) {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
        $path = $request->file('media')->store('posyandu', 'public');
    }

    $posyandu->update($request->only(['nama', 'alamat', 'rt', 'rw', 'kontak']) + ['media' => $path]);

    return redirect()->route('dataPosyandu.index')->with('success', 'Data berhasil diperbarui!');
}

public function destroy(Posyandu $posyandu)
{
    if ($posyandu->media && Storage::disk('public')->exists($posyandu->media)) {
        Storage::disk('public')->delete($posyandu->media);
    }

    $posyandu->delete();

    return redirect()->route('dataPosyandu.index')->with('success', 'Data berhasil dihapus!');
}
}