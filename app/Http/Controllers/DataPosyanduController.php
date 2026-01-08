<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataPosyanduController extends Controller
{
    // ========================
    // INDEX + SEARCH + FILTER
    // ========================
    public function index(Request $request)
    {
        $search = $request->search;
        $filterRw = $request->rw;
        $filterRt = $request->rt;

        $data = Posyandu::when($search, function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                          ->orWhere('alamat', 'like', "%{$search}%")
                          ->orWhere('kontak', 'like', "%{$search}%");
                })
                ->when($filterRw, fn($q) => $q->where('rw', $filterRw))
                ->when($filterRt, fn($q) => $q->where('rt', $filterRt))
                ->orderBy('nama')
                ->paginate(5)
                ->withQueryString();

        return view('pages.dataPosyandu.index', compact('data', 'search', 'filterRw', 'filterRt'));
    }

    // ========================
    // SHOW CREATE PAGE
    // ========================
    public function create()
    {
        return view('pages.dataPosyandu.create');
    }

    // ========================
    // STORE DATA
    // ========================
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

        Posyandu::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,   
            'rt' => $request->rt,
            'rw' => $request->rw,
            'kontak' => $request->kontak,
            'media' => $path
        ]);

        return redirect()->route('dataPosyandu.index')->with('success', 'Data berhasil ditambahkan!');
    }

    // ========================
    // EDIT PAGE
    // ========================
    public function edit($id)
    {
        $posyandu = Posyandu::findOrFail($id);
        return view('pages.dataPosyandu.edit', compact('posyandu'));
    }

    // ========================
    // UPDATE DATA
    // ========================
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

        $posyandu->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'kontak' => $request->kontak,
            'media' => $path
        ]);

        return redirect()->route('dataPosyandu.index')->with('success', 'Data berhasil diperbarui!');
    }

    // ========================
    // DELETE DATA
    // ========================
    public function destroy(Posyandu $posyandu)
    {
        if ($posyandu->media && Storage::disk('public')->exists($posyandu->media)) {
            Storage::disk('public')->delete($posyandu->media);
        }

        $posyandu->delete();

        return redirect()->route('dataPosyandu.index')->with('success', 'Data berhasil dihapus!');
    }
}
