@extends('layouts.app')
@section('title', 'Detail Layanan Posyandu')

@section('content')
<div class="container mt-4">
    <h2>Detail Layanan Posyandu</h2>
    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Nama Warga:</strong> {{ $layanan->warga->nama ?? '-' }}</p>
            <p><strong>Tema Jadwal:</strong> {{ $layanan->jadwal->tema ?? '-' }}</p>
            <p><strong>Tanggal:</strong> {{ $layanan->jadwal->tanggal ?? '-' }}</p>
            <p><strong>Berat:</strong> {{ $layanan->berat }} kg</p>
            <p><strong>Tinggi:</strong> {{ $layanan->tinggi }} cm</p>
            <p><strong>Vitamin:</strong> {{ $layanan->vitamin }}</p>
            <p><strong>Konseling:</strong> {{ $layanan->konseling }}</p>
        </div>
    </div>
    <a href="{{ route('layanan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
