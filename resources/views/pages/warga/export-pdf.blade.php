<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Warga</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .filter-info { margin-bottom: 15px; padding: 10px; background-color: #f8f9fa; border-radius: 5px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th { background-color: #40534C; color: white; padding: 8px; text-align: left; border: 1px solid #ddd; }
        .table td { padding: 8px; border: 1px solid #ddd; }
        .text-center { text-align: center; }
        .footer { margin-top: 20px; text-align: right; font-size: 10px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h2>DATA WARGA</h2>
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
                <th>ID</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Jenis Kelamin</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Tanggal Lahir</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td class="text-center">{{ $item->id }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->nik }}</td>
                <td class="text-center">{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                <td>{{ $item->no_hp ?? '-' }}</td>
                <td>{{ $item->alamat }}</td>
                <td class="text-center">
                    @if($item->tanggal_lahir)
                        {{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d/m/Y') }}
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Total Data: {{ $data->count() }}
    </div>
</body>
</html>