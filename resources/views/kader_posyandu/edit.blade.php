@extends('admin.layout.master')
@section('title', 'Edit Kader')
@section('content')
<div class="container mt-4">
    <h3>Edit Data Kader</h3>
  <form action="{{ route('kader-posyandu.update', $kader_posyandu->kader_id) }}" method="POST">
    @csrf
    @method('PUT')
        <div class="mb-3">
            <label>Peran</label>
            <input type="text" name="peran" class="form-control" value="{{ $kader_posyandu->peran }}" required>
        </div>
        <div class="mb-3">
            <label>Mulai Tugas</label>
            <input type="date" name="mulai_tugas" class="form-control" value="{{ $kader_posyandu->mulai_tugas }}" required>
        </div>
        <div class="mb-3">
            <label>Akhir Tugas</label>
            <input type="date" name="akhir_tugas" class="form-control" value="{{ $kader_posyandu->akhir_tugas }}">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('kader.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
