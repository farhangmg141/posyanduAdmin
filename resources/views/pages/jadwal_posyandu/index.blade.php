@extends('layout.admin.master')
@section('title', 'Daftar Jadwal Posyandu')

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
        border: 1px solid rgba(255,255,255,.1);
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
    }

    thead {
        background: #4b6459;
    }

    thead th {
        padding: 14px;
        font-size: 12px;
        text-transform: uppercase;
        color: #f1fbf7;
        border-bottom: none;
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
        border-top: 1px solid rgba(255,255,255,.05);
        vertical-align: middle;
        text-align: center;
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

    /* RESPONSIVE */
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
        <i class="bi bi-calendar-event me-2"></i> Daftar Jadwal Posyandu
    </h3>

    <a href="{{ route('jadwal.create') }}" class="btn btn-add">
        <i class="bi bi-plus-circle me-1"></i> Tambah Jadwal
    </a>
</div>

{{-- ===================== FILTER ===================== --}}
<div class="admin-card">
    <div class="filter-box">
        <form method="GET" action="{{ route('jadwal.index') }}">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control"
                        placeholder="Cari tema atau keterangan..."
                        value="{{ request('search') }}">
                </div>

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

                <div class="col-md-3">
                    <input type="date" name="tanggal" class="form-control"
                        value="{{ request('tanggal') }}">
                </div>

                <div class="col-md-2">
                    <button class="btn btn-success w-100 fw-bold">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
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
                    <th>ID</th>
                    <th>Posyandu</th>
                    <th>Tanggal</th>
                    <th>Tema</th>
                    <th>Keterangan</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($jadwal as $item)
                <tr>
                    <td class="fw-bold">{{ $item->jadwal_id }}</td>
                    <td>{{ $item->posyandu->nama ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $item->tema }}</td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                    <td class="aksi">
                        <a href="{{ route('jadwal.show', $item->jadwal_id) }}"
                           class="btn btn-info">
                            <i class="bi bi-eye"></i> Detail
                        </a>

                        <a href="{{ route('jadwal.edit', $item->jadwal_id) }}"
                           class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>

                        <form action="{{ route('jadwal.destroy', $item->jadwal_id) }}"
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
                    <td colspan="6" class="py-5">
                        <i class="bi bi-calendar-x display-6 d-block mb-2"></i>
                        Belum ada data jadwal
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-3 px-3 pb-3 d-flex justify-content-center">
        {{ $jadwal->links('pagination::bootstrap-5') }}
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
                text: 'Data yang dihapus tidak bisa dikembalikan!',
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
