@extends('layout.admin.master')

@section('content')
<div class="container mt-4">

    <h2 class="mb-3">Data Layanan Posyandu</h2>

    <form method="GET" class="row mb-3">

        <div class="col-md-3">
            <input type="text" name="search" placeholder="Cari..." value="{{ request('search') }}" class="form-control">
        </div>

        <div class="col-md-3">
            <select name="jadwal_id" class="form-control">
                <option value="">Filter Jadwal</option>
                @foreach ($jadwal as $j)
                    <option value="{{ $j->jadwal_id }}" {{ request('jadwal_id') == $j->jadwal_id ? 'selected' : '' }}>
                        {{ $j->tanggal }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <select name="warga_id" class="form-control">
                <option value="">Filter Warga</option>
                @foreach ($warga as $w)
                    <option value="{{ $w->id }}" {{ request('warga_id') == $w->id ? 'selected' : '' }}>
                        {{ $w->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <button class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <a href="{{ route('layanan.create') }}" class="btn btn-success mb-3">+ Tambah Layanan</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Warga</th>
                <th>Jadwal</th>
                <th>BB</th>
                <th>TB</th>
                <th>Vitamin</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($layanan as $l)
                <tr>
                    <td>{{ $l->layanan_id }}</td>
                    <td>{{ $l->warga->nama }}</td>
                    <td>{{ $l->jadwal->tanggal }}</td>
                    <td>{{ $l->berat }}</td>
                    <td>{{ $l->tinggi }}</td>
                    <td>{{ $l->vitamin }}</td>
                    <td>
                        <a href="{{ route('layanan.show', $l->layanan_id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('layanan.edit', $l->layanan_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('layanan.destroy', $l->layanan_id) }}" class="d-inline" method="POST">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">Tidak ada data.</td></tr>
            @endforelse
        </tbody>

    </table>

    <div class="d-flex justify-content-center">
        {{ $layanan->links() }}
    </div>

</div>
@include('layout.admin.footer')

@endsection
