<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use App\Exports\WargaExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $query = Warga::query();
        
      
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nik', 'like', '%' . $search . '%')
                  ->orWhere('alamat', 'like', '%' . $search . '%');
            });
        }
        
        
        if ($request->has('jenis_kelamin') && !empty($request->jenis_kelamin)) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }
        
        
        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'desc');
        
        if (in_array($sortField, ['nama', 'nik', 'jenis_kelamin', 'tanggal_lahir'])) {
            $query->orderBy($sortField, $sortDirection);
        } else {
            $query->orderBy('id', 'desc');
        }
        
        $data = $query->paginate(10);
        
        return view('pages.warga.index', compact('data', 'sortField', 'sortDirection'));
    }

    public function create()
    {
        return view('pages.warga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'nik' => 'required|numeric|unique:warga',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'nullable|date',
        ]);

        Warga::create($request->all());
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan');
    }

    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        return view('pages.warga.edit', compact('warga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'nik' => 'required|numeric|unique:warga,nik,' . $id,
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'nullable|date',
        ]);

        $warga = Warga::findOrFail($id);
        $warga->update($request->all());

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
        $warga = Warga::findOrFail($id);
        return view('pages.warga.show', compact('warga'));
    }

    /**
     * Export Excel
     */
    public function exportExcel(Request $request)
    {
        $filename = 'data-warga-' . date('Y-m-d-H-i') . '.xlsx';
        return Excel::download(new WargaExport($request), $filename);
    }

    /**
     * Export PDF
     */
    public function exportPdf(Request $request)
    {
        $query = Warga::query();
        
        // Apply filters sama seperti index
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nik', 'like', '%' . $search . '%')
                  ->orWhere('alamat', 'like', '%' . $search . '%');
            });
        }
        
        if ($request->has('jenis_kelamin') && !empty($request->jenis_kelamin)) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }
        
        $data = $query->orderBy('id', 'desc')->get();
        $filterInfo = $this->getFilterInfo($request);
        
        $pdf = Pdf::loadView('pages.warga.export-pdf', compact('data', 'filterInfo'));
        return $pdf->download('data-warga-' . date('Y-m-d') . '.pdf');
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
        
        if ($request->has('jenis_kelamin') && !empty($request->jenis_kelamin)) {
            $filters[] = "Jenis Kelamin: " . ($request->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan');
        }
        
        return $filters;
    }
}