@extends('layout.admin.master')

@section('title', 'Tambah Catatan Imunisasi')

@section('content')

<div class="container mt-4">
    <h2>Tambah Catatan Imunisasi</h2>

    <form action="{{ route('imunisasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Warga</label>
            <select name="warga_id" class="form-control" required>
                <option value="">-- Pilih Warga --</option>
                @foreach ($warga as $w)
                    <option value="{{ $w->id }}">{{ $w->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Jenis Vaksin</label>
            <input type="text" name="jenis_vaksin" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nakes</label>
            <input type="text" name="nakes" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Media (optional)</label>
            <input type="file" name="media" class="form-control">
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('imunisasi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

@endsection
