@extends('layout.admin.master')

@section('content')
<div class="container mt-4">

<h2>Edit Layanan</h2>

<form method="POST" action="{{ route('layanan.update', $item->layanan_id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Jadwal</label>
        <select name="jadwal_id" class="form-control">
            @foreach ($jadwal as $j)
                <option value="{{ $j->jadwal_id }}" 
                    {{ $item->jadwal_id == $j->jadwal_id ? 'selected' : '' }}>
                    {{ $j->tanggal }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Warga</label>
        <select name="warga_id" class="form-control">
            @foreach ($warga as $w)
                <option value="{{ $w->id }}" 
                    {{ $item->warga_id == $w->id ? 'selected' : '' }}>
                    {{ $w->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3"><label>Berat</label>
        <input type="number" step="0.1" name="berat" value="{{ $item->berat }}" class="form-control">
    </div>

    <div class="mb-3"><label>Tinggi</label>
        <input type="number" step="0.1" name="tinggi" value="{{ $item->tinggi }}" class="form-control">
    </div>

    <div class="mb-3"><label>Vitamin</label>
        <input type="text" name="vitamin" value="{{ $item->vitamin }}" class="form-control">
    </div>

    <div class="mb-3"><label>Konseling</label>
        <textarea name="konseling" class="form-control">{{ $item->konseling }}</textarea>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="{{ route('layanan.index') }}" class="btn btn-secondary">Kembali</a>

</form>

</div>
@endsection
