@extends('layouts.app')
@section('title', 'Daftar Layanan Posyandu')

@section('content')
<div class="container mt-4">
    <h2>Daftar Layanan Posyandu</h2>

    <a href="{{ route('layanan.create') }}" class="btn btn-primary mb-3">+ Tambah Layanan</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Warga</th>
                <th>Jadwal</th>
                <th>Berat</th>
                <th>Tinggi</th>
                <th>Vitamin</th>
                <th>Konseling</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($layanan as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->warga->nama ?? '-' }}</td>
                <td>{{ $item->jadwal->tema ?? '-' }}</td>
                <td>{{ $item->berat }} kg</td>
                <td>{{ $item->tinggi }} cm</td>
                <td>{{ $item->vitamin }}</td>
                <td>{{ $item->konseling }}</td>
                <td>
                    <a href="{{ route('layanan.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('layanan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('layanan.destroy', $item->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center">Belum ada data layanan</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
