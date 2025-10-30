@extends('admin.layout.master')
@section('title', 'Edit Warga')
@section('content')
<div class="container mt-4">
    <h3>Edit Data Warga</h3>
    <form action="{{ route('warga.update', $warga->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ $warga->nama }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>NIK</label>
            <input type="text" name="nik" value="{{ $warga->nik }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" value="{{ $warga->no_hp }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control">{{ $warga->alamat }}</textarea>
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control">
                <option value="L" {{ $warga->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ $warga->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Tanggal Lahir</label>
            
<form action="{{ route('warga.update', $warga->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" value="{{ old('nama', $warga->nama) }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Alamat</label>
        <input type="text" name="alamat" value="{{ old('alamat', $warga->alamat) }}" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Update</button>
</form>



        <a href="{{ route('warga.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
