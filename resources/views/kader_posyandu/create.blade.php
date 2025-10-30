@extends('admin.layout.master')
@section('title', 'Tambah Kader')
@section('content')
<div class="container mt-4">
    <h3>Tambah Kader Posyandu</h3>
    <form action="{{ route('kader.store') }}" method="POST">

        @csrf
        <div class="mb-3">
            <label>Posyandu</label>
            <select name="posyandu_id" class="form-control">
                @foreach($posyandu as $p)
                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Warga</label>
            <select name="warga_id" class="form-control">
                @foreach($warga as $w)
                    <option value="{{ $w->id }}">{{ $w->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3"><label>Peran</label>
            <input type="text" name="peran" class="form-control" required>
        </div>
        <div class="mb-3"><label>Mulai Tugas</label>
            <input type="date" name="mulai_tugas" class="form-control" required>
        </div>
        <div class="mb-3"><label>Akhir Tugas</label>
            <input type="date" name="akhir_tugas" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('kader.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
