@extends('admin.layout.master')
@section('title', 'Detail Warga')

@section('content')
<style>
    body {
        background-color: #1A3636;
        color: #D6BD98;
        font-family: 'Poppins', sans-serif;
    }

    .container {
        background-color: #40534C;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        max-width: 600px;
    }

    h3 {
        color: #D6BD98;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .list-group-item {
        background-color: #677D6A;
        color: #F5F5F5;
        border: none;
        border-radius: 8px;
        margin-bottom: 10px;
        padding: 12px 16px;
    }

    .list-group-item strong {
        color: #D6BD98;
    }

    .btn-secondary {
        background-color: #D6BD98;
        color: #1A3636;
        font-weight: 500;
        border: none;
        border-radius: 8px;
        padding: 8px 16px;
        transition: 0.3s;
    }

    .btn-secondary:hover {
        background-color: #C8A97E;
        color: #1A3636;
    }
</style>

<div class="container mt-4">
    <h3>Detail Warga</h3>
    <ul class="list-group">
        <li class="list-group-item"><strong>Nama:</strong> {{ $warga->nama }}</li>
        <li class="list-group-item"><strong>NIK:</strong> {{ $warga->nik }}</li>
        <li class="list-group-item"><strong>No HP:</strong> {{ $warga->no_hp ?? '-' }}</li>
        <li class="list-group-item"><strong>Alamat:</strong> {{ $warga->alamat ?? '-' }}</li>
        <li class="list-group-item"><strong>Jenis Kelamin:</strong> 
            {{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
        </li>
        <li class="list-group-item"><strong>Tanggal Lahir:</strong> {{ $warga->tanggal_lahir ?? '-' }}</li>
    </ul>
    <a href="{{ route('warga.index') }}" class="btn btn-secondary mt-3">← Kembali</a>
</div>
@endsection
