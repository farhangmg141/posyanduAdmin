@extends('layout.admin.master')
@section('title', 'Edit Jadwal Posyandu')

@section('content')
<div class="container mt-4">
    <h2>Edit Jadwal Posyandu</h2>

    {{-- Pastikan parameternya pakai $jadwal->jadwal_id --}}
    <form action="{{ route('jadwal.update', $jadwal->jadwal_id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Dropdown Posyandu --}}
        <div class="mb-3">
            <label>Pilih Posyandu</label>
            <select name="posyandu_id" class="form-control" required>
                <option value="">-- Pilih Posyandu --</option>
                @foreach($posyandu as $p)
                    <option value="{{ $p->id }}" {{ $jadwal->posyandu_id == $p->id ? 'selected' : '' }}>
                        {{ $p->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Input tanggal --}}
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $jadwal->tanggal }}" required>
        </div>

        {{-- Input tema --}}
        <div class="mb-3">
            <label>Tema</label>
            <input type="text" name="tema" class="form-control" value="{{ $jadwal->tema }}" required>
        </div>

        {{-- Input keterangan --}}
        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control">{{ $jadwal->keterangan }}</textarea>
        </div>

        {{-- Tombol aksi --}}
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('jadwal.index') }}" class="btn btn-warning">Batal</a>
    </form>
</div>
@endsection
