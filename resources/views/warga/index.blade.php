@extends('admin.layout.master')

@section('title', 'Data Warga')

@section('content')
{{-- SweetAlert2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@include('admin.layout.css')

<div class="container mt-4">
    <h2 class="mb-4">Daftar Warga</h2>
    <a href="{{ route('warga.create') }}" class="btn btn-primary mb-3">+ Tambah Warga</a>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
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

    <table class="table table-bordered table-striped align-middle text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Jenis Kelamin</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Tanggal Lahir</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->nik }}</td>
                <td>{{ $item->jenis_kelamin }}</td>
                <td>{{ $item->no_hp }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->tanggal_lahir }}</td>
                <td>
                    <a href="{{ route('warga.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('warga.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    
                    {{-- Tombol Hapus pakai SweetAlert --}}
                    <form action="{{ route('warga.destroy', $item->id) }}" method="POST" class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm btn-delete">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- SweetAlert Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Konfirmasi hapus
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
