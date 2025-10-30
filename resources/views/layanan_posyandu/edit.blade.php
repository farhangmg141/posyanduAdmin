@extends('layouts.app')
@section('title', 'Edit Layanan Posyandu')

@section('content')


<div class="container mt-4">
    <h2>Edit Layanan Posyandu</h2>

    <form action="{{ route('layanan.update', $layanan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Jadwal</label>
            <select name="jadwal_id" class="form-control" required>
                @foreach($jadwal as $j)
                    <option value="{{ $j->id }}" {{ $layanan->jadwal_id == $j->id ? 'selected' : '' }}>
                        {{ $j->tema }} ({{ $j->tanggal }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Warga</label>
            <select name="warga_id" class="form-control" required>
                @foreach($warga as $w)
                    <option value="{{ $w->id }}" {{ $layanan->warga_id == $w->id ? 'selected' : '' }}>
                        {{ $w->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Berat (kg)</label>
                <input type="number" name="berat" step="0.1" class="form-control" value="{{ $layanan->berat }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Tinggi (cm)</label>
                <input type="number" name="tinggi" step="0.1" class="form-control" value="{{ $layanan->tinggi }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Vitamin</label>
            <input type="text" name="vitamin" class="form-control" value="{{ $layanan->vitamin }}">
        </div>

        <div class="mb-3">
            <label>Konseling</label>
            <textarea name="konseling" class="form-control" rows="3">{{ $layanan->konseling }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('layanan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
