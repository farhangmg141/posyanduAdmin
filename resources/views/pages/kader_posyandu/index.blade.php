@extends('layout.admin.master')

@section('title', 'Kader Posyandu')
@section('content')
<!-- Tambahkan SweetAlert2 dari CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@include('layout.admin.css')

<div class="container mt-4">
    <h2>Daftar Kader Posyandu</h2>
    <a href="{{ route('kader.create') }}" class="btn btn-primary mb-3">+ Tambah Kader</a>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Warga</th>
                    <th>Posyandu</th>
                    <th>Peran</th>
                    <th>Mulai Tugas</th>
                    <th>Akhir Tugas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td>{{ $item->kader_id }}</td>
                    <td>{{ $item->warga->nama ?? '-' }}</td>
                    <td>{{ $item->posyandu->nama ?? '-' }}</td>
                    <td>{{ $item->peran }}</td>
                    <td>{{ $item->mulai_tugas }}</td>
                    <td>{{ $item->akhir_tugas ?? '-' }}</td>
                    <td>
                        <a href="{{ route('kader.show', $item->kader_id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('kader.edit', $item->kader_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('kader.destroy', $item->kader_id) }}" method="POST" class="d-inline form-delete">
                            @csrf @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm btn-hapus">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<!-- SweetAlert Script -->
<script src="{{ asset('js/dashboard-chart.js') }}"></script>



<script>
document.addEventListener('DOMContentLoaded', function () {
    // Notifikasi sukses (jika ada)
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: @json(session('success')),
            confirmButtonColor: '#677D6A',
            background: '#40534C',
            color: '#D6BD98',
        });
    @endif

    // Konfirmasi hapus
    document.querySelectorAll('.btn-hapus').forEach(function(button) {
        button.addEventListener('click', function(e) {
            const form = this.closest('.form-delete');
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data ini tidak bisa dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#A94442',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!'
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
