@extends('layout.admin.master')

@section('content')
<div class="container mt-4">

<h2>Tambah Layanan</h2>

<form method="POST" action="{{ route('layanan.store') }}">
    @csrf

    <div class="mb-3">
        <label>Jadwal</label>
        <select name="jadwal_id" class="form-control">
            @foreach ($jadwal as $j)
                <option value="{{ $j->jadwal_id }}">{{ $j->tanggal }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Warga</label>
        <select name="warga_id" class="form-control">
            @foreach ($warga as $w)
                <option value="{{ $w->id }}">{{ $w->nama }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3"><label>Berat</label>
        <input type="number" step="0.1" name="berat" class="form-control">
    </div>

    <div class="mb-3"><label>Tinggi</label>
        <input type="number" step="0.1" name="tinggi" class="form-control">
    </div>

    <div class="mb-3"><label>Vitamin</label>
        <input type="text" name="vitamin" class="form-control">
    </div>

    <div class="mb-3"><label>Konseling</label>
        <textarea name="konseling" class="form-control"></textarea>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('layanan.index') }}" class="btn btn-secondary">Kembali</a>

</form>

</div>
@endsection
