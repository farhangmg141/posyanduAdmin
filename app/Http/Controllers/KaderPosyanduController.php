<?php

namespace App\Http\Controllers;

use App\Models\KaderPosyandu;
use App\Models\Warga;
use App\Models\Posyandu;
use Illuminate\Http\Request;
use App\Exports\KaderPosyanduExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class KaderPosyanduController extends Controller
{
    public function index(Request $request)
    {
        $query = KaderPosyandu::with(['warga', 'posyandu']);
        
        // Filter berdasarkan pencarian nama
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('warga', function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            });
        }
        
        // Filter berdasarkan posyandu
        if ($request->has('posyandu') && !empty($request->posyandu)) {
            $query->where('posyandu_id', $request->posyandu);
        }
        
        // Filter berdasarkan peran
        if ($request->has('peran') && !empty($request->peran)) {
            $query->where('peran', $request->peran);
        }
        
        // Filter berdasarkan status
        if ($request->has('status') && !empty($request->status)) {
            if ($request->status == 'aktif') {
                $query->where(function($q) {
                    $q->whereNull('akhir_tugas')
                      ->orWhere('akhir_tugas', '>', now());
                });
            } elseif ($request->status == 'nonaktif') {
                $query->where('akhir_tugas', '<=', now());
            }
        }
        
        $data = $query->orderBy('kader_id', 'desc')->paginate(10);
        $posyanduList = Posyandu::all();
        
        return view('pages.kader_posyandu.index', compact('data', 'posyanduList'));
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
            'akhir_tugas' => 'nullable|date|after:mulai_tugas',
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
            'akhir_tugas' => 'nullable|date|after:mulai_tugas',
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

    /**
     * Export Excel
     */
    public function exportExcel(Request $request)
    {
        $filename = 'data-kader-posyandu-' . date('Y-m-d-H-i') . '.xlsx';
        
        return Excel::download(new KaderPosyanduExport($request), $filename);
    }

    /**
     * Export PDF
     */
    public function exportPdf(Request $request)
    {
        $query = KaderPosyandu::with(['warga', 'posyandu']);
        
        // Apply filters sama seperti index
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('warga', function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            });
        }
        
        if ($request->has('posyandu') && !empty($request->posyandu)) {
            $query->where('posyandu_id', $request->posyandu);
        }
        
        if ($request->has('peran') && !empty($request->peran)) {
            $query->where('peran', $request->peran);
        }
        
        if ($request->has('status') && !empty($request->status)) {
            if ($request->status == 'aktif') {
                $query->where(function($q) {
                    $q->whereNull('akhir_tugas')
                      ->orWhere('akhir_tugas', '>', now());
                });
            } elseif ($request->status == 'nonaktif') {
                $query->where('akhir_tugas', '<=', now());
            }
        }
        
        $data = $query->orderBy('kader_id', 'desc')->get();
        $filterInfo = $this->getFilterInfo($request);
        
        $pdf = PDF::loadView('pages.kader_posyandu.export-pdf', compact('data', 'filterInfo'));
        
        return $pdf->download('kader-posyandu-' . date('Y-m-d') . '.pdf');
    }

    /**
     * Helper untuk mendapatkan info filter
     */
    private function getFilterInfo($request)
    {
        $filters = [];
        
        if ($request->has('search') && !empty($request->search)) {
            $filters[] = "Pencarian: " . $request->search;
        }
        
        if ($request->has('posyandu') && !empty($request->posyandu)) {
            $posyandu = Posyandu::find($request->posyandu);
            $filters[] = "Posyandu: " . ($posyandu->nama ?? '-');
        }
        
        if ($request->has('peran') && !empty($request->peran)) {
            $filters[] = "Peran: " . $request->peran;
        }
        
        if ($request->has('status') && !empty($request->status)) {
            $filters[] = "Status: " . ucfirst($request->status);
        }
        
        return $filters;
    }
}