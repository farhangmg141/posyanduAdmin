@extends('admin.layout.master')
@section('title', 'Edit Posyandu')

@section('content')
<div class="container animate-fadein">
    <h2 class="mb-4 text-beige">Edit Posyandu</h2>

    <div class="card p-4 shadow-lg">
        <form id="editForm" action="{{ route('dataPosyandu.update', $posyandu->posyandu_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label text-beige">Nama Posyandu</label>
                <input type="text" name="nama" class="form-control" value="{{ $posyandu->nama }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-beige">Alamat</label>
                <textarea name="alamat" class="form-control" required>{{ $posyandu->alamat }}</textarea>
            </div>

            <div class="mb-3 d-flex gap-2">
                <div class="flex-fill">
                    <label class="form-label text-beige">RT</label>
                    <input type="text" name="rt" class="form-control" value="{{ $posyandu->rt }}" required>
                </div>
                <div class="flex-fill">
                    <label class="form-label text-beige">RW</label>
                    <input type="text" name="rw" class="form-control" value="{{ $posyandu->rw }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label text-beige">Kontak</label>
                <input type="text" name="kontak" class="form-control" value="{{ $posyandu->kontak }}">
            </div>

            <div class="mb-3">
                <label class="form-label text-beige">Foto Tempat/Alat</label><br>
                @if ($posyandu->media)
                    <img src="{{ asset('storage/'.$posyandu->media) }}" width="100" class="mb-2 rounded shadow-sm img-hover">
                @endif
                <input type="file" name="media" class="form-control mt-2">
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-success px-4" id="btnUpdate">
                    <i class="bi bi-save"></i> Update
                </button>
                <a href="{{ route('dataPosyandu.index') }}" class="btn btn-secondary px-4">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>


{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.successMessage = "{{ session('success') }}";
</script>
<script src="{{ asset('assetsAdmin/js/dataPosyandu-edit.js') }}"></script>

{{-- CSS Tema --}}
<link rel="stylesheet" href="{{ asset('assetsAdmin/css/dataPosyandu-edit.css') }}">


{{-- Style tambahan agar sejalan dengan tema --}}
<style>
    .text-beige { color: #d6c6a1; }
    .card {
        background-color: rgba(40, 60, 55, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 15px;
    }
    .form-control {
        background-color: #223a36;
        color: #d6c6a1;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .form-control:focus {
        background-color: #2c4a45;
        color: #fff;
        border-color: #b8b28c;
        box-shadow: 0 0 8px rgba(255, 255, 255, 0.15);
    }
    .img-hover {
        transition: 0.3s ease-in-out;
    }
    .img-hover:hover {
        transform: scale(1.1);
        box-shadow: 0 0 10px rgba(255,255,255,0.2);
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadein {
        animation: fadeIn 0.8s ease forwards;
    }
</style>
@endsection
