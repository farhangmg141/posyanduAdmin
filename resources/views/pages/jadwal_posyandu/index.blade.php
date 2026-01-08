@extends('layout.admin.master')
@section('title', 'Daftar Jadwal Posyandu')

@section('content')

@include('layout.admin.css')

{{-- Container Full --}}
<div class="container-fluid mt-4"> 
    <h2 class="mb-4">Daftar Jadwal Posyandu</h2>

    {{-- Tombol Tambah Data --}}
    <a href="{{ route('jadwal.create') }}" class="btn btn-primary mb-3">+ Tambah Jadwal</a>

    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: @json(session('success')),
                    confirmButtonColor: '#677D6A',
                    background: '#40534C',
                    color: '#D6BD98'
                });
            });
        </script>
    @endif
{{-- Filter & Search --}}
<form method="GET" action="{{ route('jadwal.index') }}" class="mb-4">

    <div class="row g-2">

        {{-- Search --}}
        <div class="col-md-4">
            <input type="text" name="search" class="form-control"
                placeholder="Cari tema atau keterangan..."
                value="{{ request('search') }}">
        </div>

        {{-- Filter Posyandu --}}
        <div class="col-md-3">
            <select name="posyandu_id" class="form-control">
                <option value="">-- Filter Posyandu --</option>
                @foreach ($posyanduList as $p)
                    <option value="{{ $p->posyandu_id }}"
                        {{ request('posyandu_id') == $p->posyandu_id ? 'selected' : '' }}>
                        {{ $p->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Filter Tanggal --}}
        <div class="col-md-3">
            <input type="date" name="tanggal" class="form-control"
                value="{{ request('tanggal') }}">
        </div>

        {{-- Tombol --}}
        <div class="col-md-2">
            <button class="btn btn-primary w-100">Filter</button>
        </div>
    </div>

</form>

    {{-- Tabel Data Jadwal --}}
    <table class="table table-bordered table-striped align-middle text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Posyandu</th>
                <th>Tanggal</th>
                <th>Tema</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jadwal as $item)
            <tr>
                <td>{{ $item->jadwal_id }}</td>
                <td>{{ $item->posyandu->nama ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                <td>{{ $item->tema }}</td>
                <td>{{ $item->keterangan ?? '-' }}</td>
                <td>
                    <a href="{{ route('jadwal.show', $item->jadwal_id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('jadwal.edit', $item->jadwal_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('jadwal.destroy', $item->jadwal_id) }}" method="POST" class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $item->jadwal_id }}">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Belum ada data jadwal</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
{{-- Pagination --}}
<div class="d-flex justify-content-center mt-3">
    {{ $jadwal->links('pagination::bootstrap-5') }}
</div>
@include('layout.admin.footer')

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Konfirmasi Hapus
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Yakin hapus data ini?',
                    text: 'Data yang dihapus tidak bisa dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#B85042',
                    cancelButtonColor: '#677D6A',
                    background: '#40534C',
                    color: '#D6BD98'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>

@endsection
