@extends('layout.admin.master')

@section('title', 'Tambah Kader')

@section('content')
<div class="container mt-4">
    <h3>Tambah Kader Posyandu</h3>

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kader.store') }}" method="POST">
        @csrf

        {{-- Posyandu --}}
        <div class="mb-3">
            <label class="form-label">Posyandu</label>
            <select name="posyandu_id" class="form-control" required>
                <option value="">-- Pilih Posyandu --</option>
                @foreach($posyandu as $p)
                    <option value="{{ $p->id }}" {{ old('posyandu_id') == $p->id ? 'selected' : '' }}>
                        {{ $p->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Warga --}}
        <div class="mb-3">
            <label class="form-label">Warga</label>
            <select name="warga_id" class="form-control" required>
                <option value="">-- Pilih Warga --</option>
                @foreach($warga as $w)
                    <option value="{{ $w->id }}" {{ old('warga_id') == $w->id ? 'selected' : '' }}>
                        {{ $w->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Peran --}}
        <div class="mb-3">
            <label class="form-label">Peran</label>
            <input
                type="text"
                name="peran"
                class="form-control"
                value="{{ old('peran') }}"
                placeholder="Ketua / Sekretaris / Bendahara / Kader"
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
                value="{{ old('mulai_tugas') }}"
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
                value="{{ old('akhir_tugas') }}"
            >
        </div>

        {{-- Tombol --}}
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">
                Simpan
            </button>
            <a href="{{ route('kader.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection
