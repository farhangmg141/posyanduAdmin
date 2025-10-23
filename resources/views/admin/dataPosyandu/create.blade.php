@extends('admin.layout.master')
@section('title', 'Tambah Posyandu')

@section('content')
<div class="container">
    <h2 class="mb-4 text-beige">Tambah Posyandu</h2>
    <div class="card p-4">
       <form action="{{ route('dataPosyandu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Nama Posyandu</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" required></textarea>
            </div>
            <div class="mb-3 d-flex gap-2">
                <div>
                    <label>RT</label>
                    <input type="text" name="rt" class="form-control" required>
                </div>
                <div>
                    <label>RW</label>
                    <input type="text" name="rw" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label>Kontak</label>
                <input type="text" name="kontak" class="form-control">
            </div>
            <div class="mb-3">
                <label>Foto Tempat/Alat</label>
                <input type="file" name="media" class="form-control">
            </div>
            <button class="btn btn-success">Simpan</button>
            <a href="{{ route('dataPosyandu.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

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
