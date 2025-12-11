@extends('layout.admin.master')
@section('title', 'Edit Dokumentasi')

@section('content')
<div class="container mt-4">
    <div class="card shadow p-4">
        <h4 class="fw-bold mb-3">✏ Edit Dokumentasi</h4>

        <form action="{{ route('dokumentasi.update', $dokumentasi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="fw-semibold">Judul</label>
                <input type="text" class="form-control" name="judul" value="{{ $dokumentasi->judul }}" required>
            </div>

            <div class="mb-3">
                <label class="fw-semibold">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" rows="3">{{ $dokumentasi->deskripsi }}</textarea>
            </div>

            <div class="mb-3">
                <label class="fw-semibold">Tambah File Baru (Opsional)</label>
                <input type="file" class="form-control" name="fotos[]" multiple accept="image/*,.pdf,.doc,.docx,.xlsx">
                <small class="text-muted">Boleh upload gambar atau file (.pdf/.doc/.docx/.xlsx)</small>
            </div>

            <hr>
            <h6 class="fw-semibold mb-3">📌 File / Foto Saat Ini</h6>

            <div class="row mb-4">
                @php use Illuminate\Support\Str; @endphp

                @foreach($dokumentasi->fotos as $item)
                <div class="col-md-3 col-6 mb-3 text-center">
                    
                    @if(Str::contains($item->mime_type, 'image'))
                        <img src="{{ asset('uploads/dokumentasi/'.$item->file_name) }}"
                             class="img-fluid rounded shadow-sm mb-2"
                             style="height: 130px; object-fit: cover;">
                        <br>
                        <a href="{{ asset('uploads/dokumentasi/'.$item->file_name) }}" 
                           target="_blank" class="btn btn-outline-primary btn-sm">
                           Lihat Full
                        </a>
                    @else
                        <div class="border p-3 rounded mb-2">
                            📄 {{ strtoupper($item->mime_type) }}
                        </div>
                        <a href="{{ asset('uploads/dokumentasi/'.$item->file_name) }}"
                           target="_blank" class="btn btn-outline-primary btn-sm">
                           Download File
                        </a>
                    @endif

                </div>
                @endforeach
            </div>

            <button class="btn btn-success">Update</button>
            <a href="{{ route('dokumentasi.index') }}" class="btn btn-secondary">Kembali</a>

        </form>
    </div>
</div>
@endsection
