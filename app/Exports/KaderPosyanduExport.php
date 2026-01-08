<?php

namespace App\Exports;

use App\Models\KaderPosyandu;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class KaderPosyanduExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Mengumpulkan data yang akan diexport
     */
    public function collection()
    {
        $query = KaderPosyandu::with(['warga', 'posyandu']);
        
        // Filter berdasarkan pencarian nama
        if ($this->request->has('search') && !empty($this->request->search)) {
            $search = $this->request->search;
            $query->whereHas('warga', function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            });
        }
        
        // Filter berdasarkan posyandu
        if ($this->request->has('posyandu') && !empty($this->request->posyandu)) {
            $query->where('posyandu_id', $this->request->posyandu);
        }
        
        // Filter berdasarkan peran
        if ($this->request->has('peran') && !empty($this->request->peran)) {
            $query->where('peran', $this->request->peran);
        }
        
        // Filter berdasarkan status
        if ($this->request->has('status') && !empty($this->request->status)) {
            if ($this->request->status == 'aktif') {
                $query->where(function($q) {
                    $q->whereNull('akhir_tugas')
                      ->orWhere('akhir_tugas', '>', now());
                });
            } elseif ($this->request->status == 'nonaktif') {
                $query->where('akhir_tugas', '<=', now());
            }
        }
        
        return $query->orderBy('kader_id', 'desc')->get();
    }

    /**
     * Header kolom untuk Excel
     */
    public function headings(): array
    {
        return [
            'ID KADER',
            'NAMA KADER',
            'POSYANDU',
            'PERAN',
            'MULAI TUGAS',
            'AKHIR TUGAS',
            'STATUS'
        ];
    }

    /**
     * Mapping data untuk setiap row
     */
    public function map($kader): array
    {
        // Format tanggal dengan aman
        $mulaiTugas = $this->formatDate($kader->mulai_tugas);
        $akhirTugas = $kader->akhir_tugas ? $this->formatDate($kader->akhir_tugas) : '-';
        
        // Tentukan status
        $status = 'AKTIF';
        if ($kader->akhir_tugas) {
            $akhirTugasDate = $this->parseDate($kader->akhir_tugas);
            $status = $akhirTugasDate && $akhirTugasDate->lt(now()) ? 'NONAKTIF' : 'AKTIF';
        }
        
        return [
            $kader->kader_id,
            $kader->warga->nama ?? '-',
            $kader->posyandu->nama ?? '-',
            $kader->peran,
            $mulaiTugas,
            $akhirTugas,
            $status
        ];
    }

    /**
     * Helper untuk format tanggal dengan aman
     */
    private function formatDate($date)
    {
        if (!$date) return '-';
        
        try {
            // Coba parse sebagai Carbon object
            $parsedDate = $this->parseDate($date);
            return $parsedDate ? $parsedDate->format('d/m/Y') : $date;
        } catch (\Exception $e) {
            // Jika gagal, return value asli
            return $date;
        }
    }

    /**
     * Helper untuk parse tanggal
     */
    private function parseDate($date)
    {
        if ($date instanceof \Carbon\Carbon) {
            return $date;
        }
        
        try {
            return Carbon::parse($date);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Styling untuk Excel
     */
    public function styles(Worksheet $sheet)
    {
        // Style untuk header (row 1)
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '40534C'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        // Auto size kolom
        foreach(range('A', 'G') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Style untuk data
        $lastRow = $sheet->getHighestRow();
        if ($lastRow > 1) {
            $sheet->getStyle('A2:G' . $lastRow)
                  ->getBorders()
                  ->getAllBorders()
                  ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            // Style untuk alignment
            $sheet->getStyle('A2:A' . $lastRow)->getAlignment()->setHorizontal('center');
            $sheet->getStyle('E2:F' . $lastRow)->getAlignment()->setHorizontal('center');
            $sheet->getStyle('G2:G' . $lastRow)->getAlignment()->setHorizontal('center');
        }

        return [
            1 => [
                'font' => [
                    'bold' => true,
                ],
            ],
        ];
    }

    /**
     * Judul sheet
     */
    public function title(): string
    {
        return 'Data Kader Posyandu';
    }
}