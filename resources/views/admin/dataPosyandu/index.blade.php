@extends('admin.layout.master')
@section('title', 'Data Posyandu')

@section('content')
<div class="container animate-fadein">
    <h2 class="mb-4 text-beige">Data Posyandu</h2>

    <a href="{{ route('dataPosyandu.create') }}" class="btn btn-primary mb-3">Tambah Posyandu</a>

    @if (session('success'))
        <div class="alert alert-success d-none" id="alert-success">{{ session('success') }}</div>
    @endif

    <div class="card p-4 shadow-lg custom-card">
    <table class="table table-bordered table-striped align-middle text-white custom-table">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>RT/RW</th>
                <th>Kontak</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->rt }}/{{ $item->rw }}</td>
                    <td>{{ $item->kontak }}</td>
                    <td>
                        @if ($item->media)
                            <img src="{{ asset('storage/'.$item->media) }}" alt="foto"
                                 width="70"
                                 class="rounded shadow-sm img-hover">
                        @else
                            <span class="text-muted">Tidak ada</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('dataPosyandu.edit', $item->posyandu_id) }}"
                           class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('dataPosyandu.destroy', $item->posyandu_id) }}"
                              method="POST"
                              class="d-inline form-hapus">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-danger btn-sm btn-hapus">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada data Posyandu.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Tambahkan SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // === Konfirmasi Hapus ===
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
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // === Notifikasi Berhasil ===
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


{{-- Tambahkan style khusus --}}
<style>
/* 🔹 Kartu */
.custom-card {
    background-color: rgba(20, 40, 35, 0.85);
    border-radius: 15px;
    border: 1px solid rgba(255, 255, 255, 0.15);
}

/* 🔹 Tabel */
/* 🔹 Tabel */
.custom-table {
    color: #fff !important;
    background-color: transparent !important;
}

.custom-table thead th {
    background-color: rgba(80, 110, 95, 0.9) !important;
    color: #ffffff !important;
    font-weight: 600;
    text-transform: uppercase;
    border-color: rgba(255, 255, 255, 0.2);
}

.custom-table tbody td {
    color: #ffffff !important; /* paksa putih */
    border-color: rgba(255, 255, 255, 0.1);
    vertical-align: middle;
}

.custom-table tbody tr:nth-child(odd) {
    background-color: rgba(40, 70, 60, 0.4) !important;
}
.custom-table tbody tr:nth-child(even) {
    background-color: rgba(30, 50, 45, 0.5) !important;
}

.custom-table tbody tr:hover {
    background-color: rgba(100, 160, 130, 0.25) !important;
}

.custom-table {
    color: #fff !important; /* teks utama putih */
}

.custom-table thead th {
    background-color: rgba(80, 110, 95, 0.9);
    color: #fff;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 0.5px;
    border-color: rgba(255, 255, 255, 0.2);
}

.custom-table tbody td {
    color: #f9f9f9;
    vertical-align: middle;
    border-color: rgba(255, 255, 255, 0.1);
}

/* Baris hover efek */
.custom-table tbody tr:hover {
    background-color: rgba(100, 160, 130, 0.25);
    transition: background-color 0.25s ease-in-out;
}

/* Gambar */
.img-hover {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.img-hover:hover {
    transform: scale(1.05);
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
}

/* Tombol */
.btn-warning {
    background-color: #d6c6a1;
    color: #1e1e1e;
    border: none;
}
.btn-warning:hover {
    background-color: #e8d5a9;
}

.btn-danger {
    background-color: #b94a48;
    border: none;
}
.btn-danger:hover {
    background-color: #d9534f;
}
</style>


@endsection
