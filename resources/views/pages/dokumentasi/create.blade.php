@extends('layout.admin.master')
@section('title', 'Tambah Dokumentasi')

@section('content')
<div class="container mt-4">
    <div class="card shadow p-4">
        <h4 class="fw-bold mb-3">Tambah Dokumentasi</h4>
        
        <form action="{{ route('admin.dokumentasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="fw-semibold">Judul</label>
                <input type="text" name="judul" 
                       class="form-control @error('judul') is-invalid @enderror" 
                       value="{{ old('judul') }}" required>
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="fw-semibold">Deskripsi</label>
                <textarea name="deskripsi" 
                          class="form-control @error('deskripsi') is-invalid @enderror" 
                          rows="3">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="fw-semibold">Upload File / Foto (Multiple)</label>
                <input type="file" name="fotos[]" 
                       class="form-control @error('fotos') is-invalid @enderror" 
                       multiple accept="image/*,.pdf,.doc,.docx,.xlsx">
                <small class="text-muted">Foto atau dokumen (pdf, doc, docx, xlsx)</small>

                @error('fotos')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
                @error('fotos.*')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-success">Simpan</button>
            <a href="{{ route('admin.dokumentasi.index') }}" class="btn btn-secondary">Kembali</a>
        </form>

    </div>
</div>
@endsection
