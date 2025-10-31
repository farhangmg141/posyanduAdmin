@extends('layout.admin.master')
@section('title', 'Data Posyandu')

@section('content')
@include('layout.admin.css')

<div class="container animate-fadein">
    <h2 class="mb-4 text-beige fw-bold">Data Posyandu</h2>

    {{-- Tombol Tambah --}}
    <a href="{{ route('dataPosyandu.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle me-1"></i> Tambah Posyandu
    </a>

    {{-- Alert Sukses --}}
    @if (session('success'))
        <div class="alert alert-success d-none" id="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Card Table --}}
    <div class="card p-4 shadow-lg custom-card">
        <table class="table table-bordered table-striped align-middle text-white custom-table">
            <thead class="text-center">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>RT/RW</th>
                    <th>Kontak</th>
                    <th>Foto</th>
                    <th width="140">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td class="text-center">{{ $item->rt }}/{{ $item->rw }}</td>
                        <td>{{ $item->kontak ?? '-' }}</td>
                        <td class="text-center">
                            @if ($item->media)
                                <img src="{{ asset('storage/' . $item->media) }}"
                                     alt="foto posyandu"
                                     width="70"
                                     class="rounded shadow-sm img-hover">
                            @else
                                <span class="text-muted">Tidak ada</span>
                            @endif
                        </td>
                        <td class="text-center">
                            {{-- Tombol Edit --}}
                           <a href="{{ route('dataPosyandu.edit', $item->id) }}" class="btn btn-warning btn-sm me-1">
    Edit
</a>


<form action="{{ route('dataPosyandu.destroy', $item->id) }}"
      method="POST" class="d-inline form-hapus">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
</form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-3">
                            Belum ada data Posyandu.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Konfirmasi hapus
    const forms = document.querySelectorAll('.form-hapus');
    forms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
    });

    // Notifikasi berhasil
    const successMessage = document.getElementById('alert-success');
    if (successMessage) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: successMessage.textContent.trim(),
            showConfirmButton: false,
            timer: 1800,
            background: '#d6f5d6',
            color: '#1b2d2a'
        });
    }
});
</script>
{{-- CSS Tema --}}
@include('layout.admin.css')

@endsection
