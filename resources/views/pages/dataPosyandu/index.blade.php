@extends('layout.admin.master')

@section('title', 'Data Posyandu')

@section('content')
@include('layout.admin.css')

<div class="container-fluid py-4 animate-fadein">

    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <h2 class="text-beige fw-bold mb-3 mb-md-0">Data Posyandu</h2>

        <a href="{{ route('dataPosyandu.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle"></i> Tambah Posyandu
        </a>
    </div>

    {{-- Alert Sukses --}}
    @if (session('success'))
        <div class="alert alert-success d-none" id="alert-success">
            {{ session('success') }}
        </div>
    @endif
{{-- Filter & Search --}}
<div class="card shadow p-3 mb-4" style="background:#2b3a33; border:0;">
    <form method="GET" class="row g-3 align-items-end">

        <div class="col-md-4">
            <label class="text-white">Cari Posyandu</label>
            <input type="text" name="search" value="{{ request('search') }}"
                   class="form-control" placeholder="Cari nama / alamat / kontak">
        </div>

        <div class="col-md-2">
            <label class="text-white">Filter RW</label>
            <input type="text" name="rw" value="{{ request('rw') }}"
                   class="form-control" placeholder="RW">
        </div>

        <div class="col-md-2">
            <label class="text-white">Filter RT</label>
            <input type="text" name="rt" value="{{ request('rt') }}"
                   class="form-control" placeholder="RT">
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-warning w-100">Filter</button>
        </div>

        <div class="col-md-2">
            <a href="{{ route('dataPosyandu.index') }}" class="btn btn-secondary w-100">Reset</a>
        </div>

    </form>
</div>

    {{-- Card Table --}}
    <div class="card shadow-lg custom-card p-0 border-0">

        <div class="table-responsive">
            <table class="table table-bordered align-middle text-white custom-table mb-0">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>RT/RW</th>
                        <th>Kontak</th>
                        <th>Foto</th>
                        <th width="150">Aksi</th>
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
                                         class="rounded shadow-sm img-hover"
                                         style="width: 70px; height:70px; object-fit: cover;">
                                @else
                                    <span class="text-muted small">Tidak ada</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    {{-- Edit --}}
                                    <a href="{{ route('dataPosyandu.edit', $item->id) }}"
                                       class="btn btn-warning btn-sm px-3">
                                        Edit
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('dataPosyandu.destroy', $item->id) }}"
                                          method="POST"
                                          class="form-hapus">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm px-3">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                Belum ada data Posyandu.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
<div class="mt-3 px-3 pb-3">
    {{ $data->links('pagination::bootstrap-5') }}
</div>

@include('layout.admin.footer')

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // Hapus
    document.querySelectorAll('.form-hapus').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
    });

    // Alert sukses
    const success = document.getElementById('alert-success');
    if (success) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: success.textContent.trim(),
            timer: 1800,
            showConfirmButton: false,
        });
    }
});
</script>

{{-- Tambahan CSS --}}
<style>
    .custom-card {
        background-color: #213830;
        border-radius: 10px;
    }

    .custom-table thead {
        background-color: #677D6A;
        color: #D6BD98;
    }

    .custom-table td, .custom-table th {
        border-color: #475749;
    }

    .img-hover {
        transition: 0.3s ease;
    }
    .img-hover:hover {
        transform: scale(1.1);
    }

    @media (max-width: 768px) {
        table tbody td:nth-child(1),
        table thead th:nth-child(1) {
            width: 50px;
        }

        .btn-sm {
            padding: 4px 8px;
            font-size: 12px;
        }

        .img-hover {
            width: 55px !important;
            height: 55px !important;
        }
    }
</style>

@endsection
