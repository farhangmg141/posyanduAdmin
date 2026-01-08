<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use App\Models\DokumentasiFoto;
use Illuminate\Http\Request;

class DokumentasiController extends Controller
{
    public function index()
    {
        $data = Dokumentasi::with('fotos')->latest()->paginate(10);
        return view('pages.dokumentasi.index', compact('data'));
    }

    public function create()
    {
        return view('pages.dokumentasi.create');
    }       

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'nullable',
            'fotos.*' => 'file|mimes:jpeg,png,jpg,pdf,doc,docx,xlsx|max:8192'
        ]);

        $dokumentasi = Dokumentasi::create($request->only('judul','deskripsi'));

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $file) {

                $name = uniqid() . '.' . $file->getClientOriginalExtension();
                $mime = $file->getMimeType();

                $file->move(public_path('uploads/dokumentasi'), $name);

                DokumentasiFoto::create([
                    'dokumentasi_id' => $dokumentasi->id,
                    'file_name' => $name,
                    'mime_type' => $mime
                ]);
            }
        }

        return redirect()->route('admin.dokumentasi.index')
            ->with('success', 'Dokumentasi berhasil ditambahkan!');
    }

    public function show(Dokumentasi $dokumentasi)
    {
        $dokumentasi->load('fotos');
        return view('pages.dokumentasi.show', compact('dokumentasi'));
    }

    public function edit(Dokumentasi $dokumentasi)
    {
        $dokumentasi->load('fotos');
        return view('pages.dokumentasi.edit', compact('dokumentasi'));
    }

    public function update(Request $request, Dokumentasi $dokumentasi)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'nullable',
            'fotos.*' => 'file|mimes:jpeg,png,jpg,pdf,doc,docx,xlsx|max:8192'
        ]);

        $dokumentasi->update($request->only('judul','deskripsi'));

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $file) {

                $name = uniqid() . '.' . $file->getClientOriginalExtension();
                $mime = $file->getMimeType();

                $file->move(public_path('uploads/dokumentasi'), $name);

                DokumentasiFoto::create([
                    'dokumentasi_id' => $dokumentasi->id,
                    'file_name' => $name,
                    'mime_type' => $mime
                ]);
            }
        }

        return redirect()->route('admin.dokumentasi.index')
            ->with('success', 'Dokumentasi berhasil diperbarui!');
    }

    public function destroy(Dokumentasi $dokumentasi)
    {
        foreach ($dokumentasi->fotos as $foto) {
            $filePath = public_path('uploads/dokumentasi/' . $foto->file_name);
            if (file_exists($filePath)) unlink($filePath);
            $foto->delete();
        }

        $dokumentasi->delete();

        return redirect()->route('admin.dokumentasi.index')
            ->with('success', 'Dokumentasi berhasil dihapus!');
    }
}
