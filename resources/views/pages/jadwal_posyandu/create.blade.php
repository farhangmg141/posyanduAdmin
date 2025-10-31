@extends('layout.admin.master')
@section('title', 'Tambah Jadwal Posyandu')

@section('content')
<div class="container mt-4">
    <h2> Tambah Jadwal Posyandu</h2>

    {{-- Form Tambah Jadwal --}}
    <form action="{{ route('jadwal.store') }}" method="POST">
        @csrf

        {{-- Pilih Posyandu --}}
        <div class="mb-3">
            <label for="posyandu_id" class="form-label">Pilih Posyandu</label>
            <select name="posyandu_id" id="posyandu_id" class="form-select" required>
                <option value="" disabled selected>-- Pilih Posyandu --</option>
                @foreach ($posyandu as $p)
                <option value="{{ $p->id }}">{{ $p->nama }}</option>
                @endforeach
            </select>
        </div>

        {{-- Input Tanggal --}}
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
        </div>

        {{-- Input Tema --}}
        <div class="mb-3">
            <label for="tema" class="form-label">Tema</label>
            <input type="text" name="tema" id="tema" class="form-control" placeholder="Masukkan tema kegiatan" required>
        </div>

        {{-- Input Keterangan --}}
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Tambahkan keterangan"></textarea>
        </div>

        {{-- Tombol Aksi --}}
        <div class="d-flex justify-content-between">
            <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </form>
</div>
@endsection
