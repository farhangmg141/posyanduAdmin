@extends('layout.admin.master')

@section('title', 'Edit Catatan Imunisasi')

@section('content')

<div class="container mt-4">
    <h2>Edit Catatan Imunisasi</h2>

    <form action="{{ route('imunisasi.update', $data->imunisasi_id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Warga</label>
            <select name="warga_id" class="form-control">
                @foreach ($warga as $w)
                    <option value="{{ $w->id }}" {{ $w->id == $data->warga_id ? 'selected' : '' }}>
                        {{ $w->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Jenis Vaksin</label>
            <input type="text" name="jenis_vaksin" value="{{ $data->jenis_vaksin }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ $data->tanggal }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" value="{{ $data->lokasi }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Nakes</label>
            <input type="text" name="nakes" value="{{ $data->nakes }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Media Saat Ini:</label><br>
            @if ($data->media)
                <a href="{{ asset('storage/' . $data->media) }}" target="_blank">Lihat File</a>
            @else
                Tidak ada file
            @endif
        </div>

        <div class="mb-3">
            <label>Upload Media Baru (optional)</label>
            <input type="file" name="media" class="form-control">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('imunisasi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

@endsection
