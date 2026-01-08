@extends('layout.admin.master')
@section('title', 'Catatan Imunisasi')

@section('content')

{{-- ===================== CSS ADMIN DARK ===================== --}}
<style>
    html, body {
        background: #0f1f1b;
        overflow-x: hidden;
    }

    .container-fluid {
        padding: 26px;
    }

    /* HEADER */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .page-header h3 {
        color: #eaf5f1;
        font-weight: 700;
        margin: 0;
    }

    .btn-add {
        background: #7da58c;
        color: #10201b;
        font-weight: 700;
        border-radius: 8px;
        padding: 8px 14px;
    }

    /* CARD */
    .admin-card {
        background: linear-gradient(180deg, #1e342e, #172722);
        border-radius: 14px;
        box-shadow: 0 10px 30px rgba(0,0,0,.3);
        overflow: hidden;
        margin-bottom: 20px;
    }

    /* FILTER */
    .filter-box {
        padding: 16px;
        background: #223b33;
    }

    .filter-box .form-control {
        background: #1b2f29;
        border: 1px solid rgba(255,255,255,.12);
        color: #ecf7f3;
    }

    .filter-box .form-control::placeholder {
        color: #9fbdb1;
    }

    /* TABLE */
    table {
        width: 100%;
        color: #ecf7f3;
        font-size: 14px;
        table-layout: fixed;
    }

    thead {
        background: #4b6459;
    }

    thead th {
        padding: 14px;
        font-size: 12px;
        text-transform: uppercase;
        color: #f1fbf7;
        text-align: center;
    }

    tbody tr {
        background: #223b33;
    }

    tbody tr:nth-child(even) {
        background: #1d322b;
    }

    tbody tr:hover {
        background: #2f5046;
    }

    tbody td {
        padding: 12px 14px;
        border-top: 1px solid rgba(255,255,255,.06);
        vertical-align: middle;
        text-align: center;
        word-break: break-word;
    }

    /* BADGE */
    .badge-vaksin {
        background: #67c1a3;
        color: #0f1f1b;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
    }

    /* AKSI */
    .aksi {
        white-space: nowrap;
    }

    .aksi .btn {
        font-size: 11px;
        font-weight: 700;
        padding: 5px 10px;
        border-radius: 6px;
    }

    /* PAGINATION */
    .pagination .page-link {
        background: #223b33;
        color: #ecf7f3;
        border: none;
        margin: 0 2px;
    }

    .pagination .active .page-link {
        background: #d6bd98;
        color: #1f2f2a;
        font-weight: 700;
    }

    .pagination .disabled .page-link {
        opacity: .4;
    }

    @media (max-width: 768px) {
        table {
            font-size: 12px;
        }

        .aksi .btn {
            display: block;
            margin-bottom: 4px;
        }
    }
</style>

{{-- ===================== HEADER ===================== --}}
<div class="page-header">
    <h3>
        <i class="bi bi-shield-plus me-2"></i> Catatan Imunisasi
    </h3>

    <a href="{{ route('imunisasi.create') }}" class="btn btn-add">
        <i class="bi bi-plus-circle me-1"></i> Tambah Imunisasi
    </a>
</div>

{{-- ===================== FILTER ===================== --}}
<div class="admin-card">
    <div class="filter-box">
        <form method="GET">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Cari nama atau vaksin...">
                </div>

                <div class="col-md-4">
                    <select name="filter" class="form-control">
                        <option value="">Filter Jenis Vaksin</option>
                        @foreach ($jenisVaksin as $v)
                            <option value="{{ $v->jenis_vaksin }}"
                                {{ request('filter') == $v->jenis_vaksin ? 'selected' : '' }}>
                                {{ $v->jenis_vaksin }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-success w-100 fw-bold">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>

                <div class="col-md-2">
                    <a href="{{ route('imunisasi.index') }}"
                       class="btn btn-secondary w-100 fw-bold">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- ===================== TABLE ===================== --}}
<div class="admin-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Warga</th>
                    <th>Vaksin</th>
                    <th>Tanggal</th>
                    <th>Lokasi</th>
                    <th>Nakes</th>
                    <th>Media</th>
                    <th width="18%">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse ($data as $row)
                <tr>
                    <td class="fw-bold">{{ $row->warga->nama }}</td>

                    <td>
                        <span class="badge-vaksin">
                            {{ $row->jenis_vaksin }}
                        </span>
                    </td>

                    <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d M Y') }}</td>
                    <td>{{ $row->lokasi }}</td>
                    <td>{{ $row->nakes }}</td>

                    <td>
                        @if ($row->media)
                            <a href="{{ asset('storage/'.$row->media) }}"
                               target="_blank"
                               class="text-decoration-none fw-bold text-info">
                                <i class="bi bi-file-earmark-text"></i> Lihat
                            </a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>

                    <td class="aksi">
                        <a href="{{ route('imunisasi.edit', $row->imunisasi_id) }}"
                           class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>

                        <form action="{{ route('imunisasi.delete', $row->imunisasi_id) }}"
                              method="POST"
                              class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                    class="btn btn-danger btn-delete">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="py-5">
                        <i class="bi bi-database-x display-6 d-block mb-2"></i>
                        Tidak ada data imunisasi
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-3 px-3 pb-3 d-flex justify-content-center gap-3">
        <a href="{{ $data->previousPageUrl() ?? '#' }}"
           class="btn btn-sm btn-secondary {{ $data->onFirstPage() ? 'disabled' : '' }}">
            ← Prev
        </a>

        <span class="text-white fw-bold">
            {{ $data->currentPage() }} / {{ $data->lastPage() }}
        </span>

        <a href="{{ $data->nextPageUrl() ?? '#' }}"
           class="btn btn-sm btn-secondary {{ !$data->hasMorePages() ? 'disabled' : '' }}">
            Next →
        </a>
    </div>
</div>

@include('layout.admin.footer')

{{-- ===================== SWEETALERT ===================== --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function () {
        Swal.fire({
            title: 'Yakin hapus data ini?',
            text: 'Data imunisasi yang dihapus tidak bisa dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            background: '#40534C',
            color: '#D6BD98'
        }).then((result) => {
            if (result.isConfirmed) {
                this.closest('form').submit();
            }
        });
    });
});

@if (session('success'))
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: @json(session('success')),
    timer: 2500,
    showConfirmButton: false,
    background: '#40534C',
    color: '#D6BD98'
});
@endif
</script>

@endsection
