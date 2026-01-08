<?php

namespace App\Http\Controllers;

use App\Models\CatatanImunisasi;
use App\Models\Warga;
use Illuminate\Http\Request;

class CatatanImunisasiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $filter = $request->filter;

        $data = CatatanImunisasi::with('warga')
            ->when($search, function ($query) use ($search) {
                $query->where('jenis_vaksin', 'like', "%$search%")
                ->orWhereHas('warga', function ($q) use ($search) {
                    $q->where('nama', 'like', "%$search%");
                });
            })
            ->when($filter, function ($query) use ($filter) {
                $query->where('jenis_vaksin', $filter);
            })
            ->orderBy('tanggal', 'DESC')
            ->paginate(10);

        $jenisVaksin = CatatanImunisasi::select('jenis_vaksin')->distinct()->get();

        return view('pages.catatan_imunisasi.index', compact('data', 'jenisVaksin'));
    }

    public function create()
    {
        $warga = Warga::all();
        return view('pages.catatan_imunisasi.create', compact('warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required',
            'jenis_vaksin' => 'required',
            'tanggal' => 'required|date',
            'lokasi' => 'required',
            'nakes' => 'required',
            'media' => 'nullable|file|mimes:jpg,png,pdf'
        ]);

        $file = null;
        if ($request->hasFile('media')) {
            $file = $request->media->store('imunisasi_files', 'public');
        }

        CatatanImunisasi::create([
            'warga_id' => $request->warga_id,
            'jenis_vaksin' => $request->jenis_vaksin,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'nakes' => $request->nakes,
            'media' => $file
        ]);

        return redirect()->route('imunisasi.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = CatatanImunisasi::findOrFail($id);
        $warga = Warga::all();
        return view('pages.catatan_imunisasi.edit', compact('data', 'warga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'warga_id' => 'required',
            'jenis_vaksin' => 'required',
            'tanggal' => 'required|date',
            'lokasi' => 'required',
            'nakes' => 'required',
            'media' => 'nullable|file|mimes:jpg,png,pdf'
        ]);

        $data = CatatanImunisasi::findOrFail($id);

        $file = $data->media;
        if ($request->hasFile('media')) {
            $file = $request->media->store('imunisasi_files', 'public');
        }

        $data->update([
            'warga_id' => $request->warga_id,
            'jenis_vaksin' => $request->jenis_vaksin,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'nakes' => $request->nakes,
            'media' => $file,
        ]);

        return redirect()->route('imunisasi.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        CatatanImunisasi::destroy($id);
        return redirect()->route('imunisasi.index')->with('success', 'Data berhasil dihapus');
    }
}
