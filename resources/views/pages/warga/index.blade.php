@extends('layout.admin.master')
@section('title', 'Data Warga')

@section('content')

{{-- ===================== CSS FINAL MIRIP DATA KADER ===================== --}}
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
    }

    .btn-add {
        background: #7da58c;
        color: #10201b;
        font-weight: 700;
        border-radius: 8px;
        padding: 8px 14px;
    }

    /* FILTER CARD */
    .filter-card {
        background: linear-gradient(180deg, #2b3f38, #25352f);
        border-radius: 14px;
        padding: 18px;
        margin-bottom: 22px;
        box-shadow: 0 8px 20px rgba(0,0,0,.25);
    }

    .filter-label {
        font-size: 13px;
        font-weight: 600;
        color: #e0f1ea;
        margin-bottom: 6px;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        font-size: 13px;
    }

    /* BUTTON FILTER */
    .btn-filter {
        background: #d6bd98;
        color: #1f2f2a;
        font-weight: 700;
        border-radius: 8px;
    }

    .btn-reset {
        background: #f1c27d;
        color: #1f2f2a;
        font-weight: 700;
        border-radius: 8px;
    }

    /* TABLE CARD */
    .table-card {
        background: linear-gradient(180deg, #1e342e, #172722);
        border-radius: 14px;
        box-shadow: 0 10px 30px rgba(0,0,0,.3);
        overflow: hidden;
    }

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
    }

    /* BADGE JK */
    .badge-jk {
        padding: 4px 10px;
        font-size: 11px;
        font-weight: 700;
        border-radius: 20px;
        display: inline-block;
    }

    .jk-l {
        background: #4da3ff;
        color: #fff;
    }

    .jk-p {
        background: #ff7ca8;
        color: #fff;
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
    <h3>Data Warga</h3>
    <a href="{{ route('warga.create') }}" class="btn btn-add">
        + Tambah Warga
    </a>
</div>

{{-- ===================== FILTER ===================== --}}
<div class="filter-card">
    <form method="GET" class="row g-3 align-items-end">

        <div class="col-md-5">
            <div class="filter-label">Cari Warga</div>
            <input type="text" name="search" class="form-control"
                   placeholder="Nama / NIK / Alamat"
                   value="{{ request('search') }}">
        </div>

        <div class="col-md-3">
            <div class="filter-label">Jenis Kelamin</div>
            <select name="jenis_kelamin" class="form-select">
                <option value="">Semua</option>
                <option value="L" {{ request('jenis_kelamin')=='L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ request('jenis_kelamin')=='P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-filter w-100">Filter</button>
        </div>

        <div class="col-md-2">
            <a href="{{ route('warga.index') }}" class="btn btn-reset w-100">Reset</a>
        </div>

    </form>
</div>

{{-- ===================== TABLE ===================== --}}
<div class="table-card">

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIK</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>JK</th>
                <th>Tgl Lahir</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
        @forelse($data as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->nik }}</td>
                <td>{{ $item->no_hp ?? '-' }}</td>
                <td>{{ $item->alamat ?? '-' }}</td>
                <td>
                    <span class="badge-jk {{ $item->jenis_kelamin=='L' ? 'jk-l' : 'jk-p' }}">
                        {{ $item->jenis_kelamin=='L' ? 'Laki-laki' : 'Perempuan' }}
                    </span>
                </td>
                <td>{{ $item->tanggal_lahir ?? '-' }}</td>

                <td class="aksi text-center">
                    <a href="{{ route('warga.show',$item->id) }}" class="btn btn-secondary">Detail</a>
                    <a href="{{ route('warga.edit',$item->id) }}" class="btn btn-warning">Edit</a>

                    <form action="{{ route('warga.destroy',$item->id) }}"
                          method="POST"
                          class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-delete">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center py-4">
                    Tidak ada data ditemukan
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="mt-3 px-3 pb-3">
        {{ $data->links('pagination::bootstrap-5') }}
    </div>

</div>

{{-- ===================== SWEETALERT ===================== --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // DELETE CONFIRM
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function () {
            Swal.fire({
                title: 'Yakin hapus?',
                text: 'Data warga akan dihapus permanen',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest('form').submit();
                }
            })
        });
    });

    // SUCCESS ALERT
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            timer: 2500,
            showConfirmButton: false
        });
    @endif
</script>

@include('layout.admin.footer')
@endsection
