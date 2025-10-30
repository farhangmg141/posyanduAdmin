@extends('admin.layout.master')
@section('title', 'Tambah Posyandu')

@include('admin.layout.css')    

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


@endsection
