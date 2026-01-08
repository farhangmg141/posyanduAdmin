@extends('layout.admin.master')

@section('title', 'Catatan Imunisasi')

@section('content')

{{-- CSS ANTI SLIDE --}}
<style>
    html, body {
        overflow-x: hidden !important;
    }

    .container {
        max-width: 100% !important;
        overflow-x: hidden;
    }

    .table-responsive {
        overflow-x: hidden !important;
    }

    table {
        width: 100%;
        table-layout: fixed;
    }

    th, td {
        white-space: normal !important;
        word-break: break-word;
        vertical-align: middle;
        font-size: 14px;
    }

    /* Kolom panjang */
    td.lokasi,
    td.nakes {
        max-width: 200px;
    }

    /* Kolom aksi */
    th.aksi,
    td.aksi {
        width: 180px;
    }

    td.aksi .btn {
        margin-bottom: 4px;
    }

    @media (max-width: 768px) {
        th, td {
            font-size: 12px;
        }

        .btn-sm {
            font-size: 11px;
            padding: 3px 6px;
        }
    }
</style>

<div class="container mt-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">
            <i class="bi bi-shield-plus"></i> Catatan Imunisasi
        </h3>
        <a href="{{ route('imunisasi.create') }}" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle"></i> Tambah Imunisasi
        </a>
    </div>

    <!-- Filter -->
    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">

                <div class="col-md-4">
                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama atau vaksin..."
                        class="form-control rounded-3 shadow-sm">
                </div>

                <div class="col-md-4">
                    <select name="filter" class="form-control rounded-3 shadow-sm">
                        <option value="">-- Filter Jenis Vaksin --</option>
                        @foreach ($jenisVaksin as $v)
                            <option value="{{ $v->jenis_vaksin }}"
                                {{ request('filter') == $v->jenis_vaksin ? 'selected' : '' }}>
                                {{ $v->jenis_vaksin }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary w-100 shadow-sm rounded-3">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>

                <div class="col-md-2">
                    <a href="{{ route('imunisasi.index') }}"
                        class="btn btn-secondary w-100 shadow-sm rounded-3">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                </div>

            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="table-primary">
                        <tr>
                            <th>Warga</th>
                            <th>Jenis Vaksin</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Tenaga Kesehatan</th>
                            <th>Media</th>
                            <th class="text-center aksi">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($data as $row)
                        <tr>
                            <td class="fw-semibold">{{ $row->warga->nama }}</td>

                            <td>
                                <span class="badge bg-info text-dark px-3 py-2 rounded-pill">
                                    {{ $row->jenis_vaksin }}
                                </span>
                            </td>

                            <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d M Y') }}</td>

                            <td class="lokasi">{{ $row->lokasi }}</td>

                            <td class="nakes">{{ $row->nakes }}</td>

                            <td>
                                @if ($row->media)
                                    <a href="{{ asset('storage/' . $row->media) }}"
                                        target="_blank"
                                        class="fw-bold text-decoration-none">
                                        <i class="bi bi-file-earmark-text"></i> Lihat
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            <td class="text-center aksi">
                                <a href="{{ route('imunisasi.edit', $row->imunisasi_id) }}"
                                    class="btn btn-warning btn-sm rounded-3 shadow-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>

                                <form action="{{ route('imunisasi.delete', $row->imunisasi_id) }}"
                                    method="POST"
                                    class="d-inline">
                                    @csrf @method('DELETE')

                                    <button type="button"
                                        class="btn btn-danger btn-sm rounded-3 shadow-sm btn-delete"
                                        data-id="{{ $row->imunisasi_id }}">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="bi bi-exclamation-circle"></i> Tidak ada data ditemukan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>

        {{-- PAGINATION --}}
       <div class="d-flex justify-content-center align-items-center gap-3 mt-4">
    <a href="{{ $data->previousPageUrl() ?? '#' }}"
        class="btn btn-sm btn-secondary {{ $data->onFirstPage() ? 'disabled' : '' }}">
        ← Prev
    </a>

    <span class="text-white">
        Page {{ $data->currentPage() }} / {{ $data->lastPage() }}
    </span>

    <a href="{{ $data->nextPageUrl() ?? '#' }}"
        class="btn btn-sm btn-secondary {{ !$data->hasMorePages() ? 'disabled' : '' }}">
        Next →
    </a>
</div>


</div>

@include('layout.admin.footer')
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function () {
        Swal.fire({
            title: "Yakin ingin hapus?",
            text: "Data imunisasi yang dihapus tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                this.closest('form').submit();
            }
        });
    });
});
</script>
@endsection
