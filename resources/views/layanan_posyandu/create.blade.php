@extends('layouts.app')
@section('title', 'Tambah Layanan Posyandu')

@section('content')
@include('admin.layout.css')

<div class="container mt-4">
    <h2> Tambah Layanan Posyandu</h2>

    <form action="{{ route('layanan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Jadwal</label>
            <select name="jadwal_id" class="form-control" required>
                <option value="">-- Pilih Jadwal --</option>
                @foreach($jadwal as $j)
                    <option value="{{ $j->id }}">{{ $j->tema }} ({{ $j->tanggal }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Warga</label>
            <select name="warga_id" class="form-control" required>
                <option value="">-- Pilih Warga --</option>
                @foreach($warga as $w)
                    <option value="{{ $w->id }}">{{ $w->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Berat (kg)</label>
                <input type="number" name="berat" step="0.1" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Tinggi (cm)</label>
                <input type="number" name="tinggi" step="0.1" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Vitamin</label>
            <input type="text" name="vitamin" class="form-control" placeholder="Contoh: Vitamin A">
        </div>

        <div class="mb-3">
            <label>Konseling</label>
            <textarea name="konseling" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('layanan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
