<?php

namespace App\Exports;

use App\Models\Warga;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class WargaExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Warga::query();
        
        if ($this->request->has('search') && !empty($this->request->search)) {
            $search = $this->request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nik', 'like', '%' . $search . '%')
                  ->orWhere('alamat', 'like', '%' . $search . '%');
            });
        }
        
        if ($this->request->has('jenis_kelamin') && !empty($this->request->jenis_kelamin)) {
            $query->where('jenis_kelamin', $this->request->jenis_kelamin);
        }
        
        return $query->orderBy('id', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'NAMA',
            'NIK',
            'JENIS KELAMIN',
            'NO HP',
            'ALAMAT',
            'TANGGAL LAHIR'
        ];
    }

    public function map($warga): array
    {
        return [
            $warga->id,
            $warga->nama,
            $warga->nik,
            $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
            $warga->no_hp ?? '-',
            $warga->alamat,
            $warga->tanggal_lahir ? Carbon::parse($warga->tanggal_lahir)->format('d/m/Y') : '-'
        ];
    }

    public function styles(Worksheet $sheet)
    {
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

        foreach(range('A', 'G') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $lastRow = $sheet->getHighestRow();
        if ($lastRow > 1) {
            $sheet->getStyle('A2:G' . $lastRow)
                  ->getBorders()
                  ->getAllBorders()
                  ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        }

        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function title(): string
    {
        return 'Data Warga';
    }
}