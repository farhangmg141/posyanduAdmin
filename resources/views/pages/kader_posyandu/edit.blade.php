@extends('layout.admin.master')

@section('title', 'Edit Kader')

@section('content')
<div class="container mt-4">
    <h3>Edit Data Kader Posyandu</h3>

    {{-- Error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kader.update', $kader_posyandu->kader_id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Posyandu (readonly) --}}
        <div class="mb-3">
            <label class="form-label">Posyandu</label>
            <input type="text"
                   class="form-control"
                   value="{{ $kader_posyandu->posyandu->nama ?? '-' }}"
                   readonly>
        </div>

        {{-- Warga (readonly) --}}
        <div class="mb-3">
            <label class="form-label">Warga</label>
            <input type="text"
                   class="form-control"
                   value="{{ $kader_posyandu->warga->nama ?? '-' }}"
                   readonly>
        </div>

        {{-- Peran --}}
        <div class="mb-3">
            <label class="form-label">Peran</label>
            <input
                type="text"
                name="peran"
                class="form-control"
                value="{{ old('peran', $kader_posyandu->peran) }}"
                required
            >
        </div>

        {{-- Mulai Tugas --}}
        <div class="mb-3">
            <label class="form-label">Mulai Tugas</label>
            <input
                type="date"
                name="mulai_tugas"
                class="form-control"
                value="{{ old('mulai_tugas', $kader_posyandu->mulai_tugas) }}"
                required
            >
        </div>

        {{-- Akhir Tugas --}}
        <div class="mb-3">
            <label class="form-label">Akhir Tugas</label>
            <input
                type="date"
                name="akhir_tugas"
                class="form-control"
                value="{{ old('akhir_tugas', $kader_posyandu->akhir_tugas) }}"
            >
        </div>

        {{-- Tombol --}}
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">
                Update
            </button>
            <a href="{{ route('kader.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection
