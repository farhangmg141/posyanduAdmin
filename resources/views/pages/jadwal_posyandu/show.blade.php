@extends('layout.admin.master')
@section('title', 'Detail Jadwal Posyandu')

@section('content')
<div class="container mt-4">
    <h2>Detail Jadwal Posyandu</h2>
    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}</p>
            <p><strong>Tema:</strong> {{ $jadwal->tema }}</p>
            <p><strong>Keterangan:</strong> {{ $jadwal->keterangan }}</p>
        </div>
    </div>
    <a href="{{ route('jadwal.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
