<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Kader Posyandu</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 12px;
            margin: 20px;
        }
        .header { 
            text-align: center; 
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            color: #333;
        }
        .filter-info {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px;
        }
        .table th { 
            background-color: #40534C; 
            color: white; 
            padding: 8px; 
            text-align: left;
            border: 1px solid #ddd;
        }
        .table td { 
            padding: 8px; 
            border: 1px solid #ddd;
        }
        .table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .text-center { text-align: center; }
        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
        .status-aktif { color: #28a745; font-weight: bold; }
        .status-nonaktif { color: #dc3545; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2>DATA KADER POSYANDU</h2>
        <p>Dicetak pada: {{ date('d/m/Y H:i') }}</p>
    </div>
    
    @if(!empty($filterInfo))
    <div class="filter-info">
        <strong>Filter yang diterapkan:</strong><br>
        @foreach($filterInfo as $filter)
        • {{ $filter }}<br>
        @endforeach
    </div>
    @endif
    
    <table class="table">
        <thead>
            <tr>
                <th width="50">ID</th>
                <th>Nama Kader</th>
                <th>Posyandu</th>
                <th>Peran</th>
                <th width="90">Mulai Tugas</th>
                <th width="90">Akhir Tugas</th>
                <th width="80">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td class="text-center">{{ $item->kader_id }}</td>
                <td>{{ $item->warga->nama ?? '-' }}</td>
                <td>{{ $item->posyandu->nama ?? '-' }}</td>
                <td>{{ $item->peran }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($item->mulai_tugas)->format('d/m/Y') }}</td>
                <td class="text-center">
                    @if($item->akhir_tugas)
                        {{ \Carbon\Carbon::parse($item->akhir_tugas)->format('d/m/Y') }}
                    @else
                        -
                    @endif
                </td>
                <td class="text-center 
                    @if($item->akhir_tugas && \Carbon\Carbon::parse($item->akhir_tugas)->lt(now())) 
                        status-nonaktif 
                    @else 
                        status-aktif 
                    @endif">
                    @if($item->akhir_tugas && \Carbon\Carbon::parse($item->akhir_tugas)->lt(now()))
                        NONAKTIF
                    @else
                        AKTIF
                    @endif
                </td>
            </tr>
            @endforeach
            @if($data->count() == 0)
            <tr>
                <td colspan="7" class="text-center">Tidak ada data</td>
            </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        Total Data: {{ $data->count() }}
    </div>
</body>
</html>