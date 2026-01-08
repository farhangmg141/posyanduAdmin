@extends('layout.admin.master')
@section('title', 'Data Warga')

@section('content')
<<<<<<< HEAD

{{-- CSS FINAL FIX --}}
<style>
    html, body {
        overflow-x: hidden !important;
    }

    .container-fluid {
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

    /* Alamat */
    td.alamat {
        max-width: 240px;
        line-height: 1.4;
    }

    /* AKSI — PERBAIKAN UTAMA */
    th.aksi,
    td.aksi {
        width: 200px;              /* LEBARKAN */
        white-space: normal !important; /* BOLEH TURUN BARIS */
    }

    td.aksi .btn {
        margin-bottom: 4px;
    }

    @media (max-width: 768px) {
        th, td {
            font-size: 12px;
        }

        td.aksi {
            width: auto;
        }

        .btn-sm {
            font-size: 11px;
            padding: 3px 6px;
        }
    }
</style>

<div class="container-fluid mt-4 px-4">

    <h3 class="mb-3 fw-bold text-white">Data Warga</h3>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- FILTER --}}
    <div class="card border-0 shadow mb-4" style="background:#213830;border-radius:12px;">
        <div class="card-body">
            <form method="GET" class="row gx-2 gy-2 align-items-center">

                <div class="col-md-4">
                    <input type="text" name="search" class="form-control"
                        style="background:#40534C;color:white;border-color:#677D6A;"
=======
<div class="container mt-4">

    <h3 class="mb-3 fw-bold" style="color: #ffffff;">Data Warga</h3>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success">
            {sesion('success')}
        </div>
    @endif

    {{-- FORM FILTER & SEARCH --}}
    <div class="card border-0 shadow mb-4" style="background-color:#213830; border-radius: 12px;">
        <div class="card-body">

            <form method="GET" class="row g-3">

                {{-- Search --}}
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control"
                        style="background:#40534C; color:white; border-color:#677D6A;"
>>>>>>> 8b8dcb9cb57b2425b848e3402d3634d98fcbe069
                        placeholder="Cari nama / NIK / alamat..."
                        value="{{ request('search') }}">
                </div>

<<<<<<< HEAD
                <div class="col-md-3">
                    <select name="jenis_kelamin" class="form-control"
                        style="background:#40534C;color:white;border-color:#677D6A;">
=======
                {{-- Filter Jenis Kelamin --}}
                <div class="col-md-3">
                    <select name="jenis_kelamin" class="form-control"
                            style="background:#40534C; color:white; border-color:#677D6A;">
>>>>>>> 8b8dcb9cb57b2425b848e3402d3634d98fcbe069
                        <option value="">-- Filter Jenis Kelamin --</option>
                        <option value="L" {{ request('jenis_kelamin')=='L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ request('jenis_kelamin')=='P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

<<<<<<< HEAD
                <div class="col-md-2">
                    <button class="btn w-100 fw-bold"
                        style="background:#D6BD98;color:#213830;">
=======
                {{-- Tombol --}}
                <div class="col-md-2">
                    <button class="btn w-100 fw-bold"
                        style="background-color:#D6BD98; color:#213830;">
>>>>>>> 8b8dcb9cb57b2425b848e3402d3634d98fcbe069
                        Filter
                    </button>
                </div>

<<<<<<< HEAD
                <div class="col-md-2">
                    <a href="{{ route('warga.index') }}"
                        class="btn w-100 fw-bold"
                        style="background:#677D6A;color:white;">
=======
                {{-- Reset --}}
                <div class="col-md-2">
                    <a href="{{ route('warga.index') }}"
                        class="btn w-100 fw-bold"
                        style="background-color:#677D6A; color:white;">
>>>>>>> 8b8dcb9cb57b2425b848e3402d3634d98fcbe069
                        Reset
                    </a>
                </div>

<<<<<<< HEAD
                <div class="col-md-1 text-end">
                    <a href="{{ route('warga.create') }}"
                        class="btn fw-bold"
                        style="background:#4CAF50;color:white;">
                        + Tambah
=======
                {{-- Tambah Data --}}
                <div class="col-md-1 text-end">
                    <a href="{{ route('warga.create') }}" 
                        class="btn fw-bold"
                        style="background-color:#4CAF50; color:white;">
                       + Tambah 
>>>>>>> 8b8dcb9cb57b2425b848e3402d3634d98fcbe069
                    </a>
                </div>

            </form>
<<<<<<< HEAD
=======

>>>>>>> 8b8dcb9cb57b2425b848e3402d3634d98fcbe069
        </div>
    </div>

    {{-- TABEL --}}
<<<<<<< HEAD
    <div class="card border-0 shadow" style="background:#213830;border-radius:12px;">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">

                    <thead style="background:#40534C;">
                        <tr>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Tgl Lahir</th>
                            <th class="text-center aksi">Aksi</th>
=======
    <div class="card border-0 shadow" style="background-color:#213830; border-radius: 12px;">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0" style="color:white;">
                    <thead style="background-color:#40534C;">
                        <tr>
                            <th>
                                <a href="{{ route('warga.index', array_merge(request()->all(), ['sort' => 'nama', 'direction' => $sortField=='nama' && $sortDirection=='asc' ? 'desc' : 'asc'])) }}"
                                   style="color:white; text-decoration:none;">
                                    Nama
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('warga.index', array_merge(request()->all(), ['sort' => 'nik', 'direction' => $sortField=='nik' && $sortDirection=='asc' ? 'desc' : 'asc'])) }}"
                                   style="color:white; text-decoration:none;">
                                    NIK
                                </a>
                            </th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>
                                <a href="{{ route('warga.index', array_merge(request()->all(), ['sort' => 'jenis_kelamin', 'direction' => $sortField=='jenis_kelamin' && $sortDirection=='asc' ? 'desc' : 'asc'])) }}"
                                   style="color:white; text-decoration:none;">
                                    Jenis Kelamin
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('warga.index', array_merge(request()->all(), ['sort' => 'tanggal_lahir', 'direction' => $sortField=='tanggal_lahir' && $sortDirection=='asc' ? 'desc' : 'asc'])) }}"
                                   style="color:white; text-decoration:none;">
                                    Tgl Lahir 
                                </a>
                            </th>
                            <th class="text-center" style="width: 160px;">Aksi</th>
>>>>>>> 8b8dcb9cb57b2425b848e3402d3634d98fcbe069
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($data as $item)
<<<<<<< HEAD
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->no_hp ?? '-' }}</td>
                            <td class="alamat">{{ $item->alamat ?? '-' }}</td>
                            <td>{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>{{ $item->tanggal_lahir ?? '-' }}</td>

                            <td class="text-center aksi">
                                <a href="{{ route('warga.show', $item->id) }}"
                                    class="btn btn-info btn-sm">Detail</a>

                                <a href="{{ route('warga.edit', $item->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('warga.destroy', $item->id) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-3 text-white">
                                Tidak ada data ditemukan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

=======
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->no_hp ?? '-' }}</td>
                                <td>{{ $item->alamat ?? '-' }}</td>
                                <td>{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $item->tanggal_lahir ?? '-' }}</td>

                                <td class="text-center">
                                    <a href="{{ route('warga.show', $item->id) }}"
                                        class="btn btn-info btn-sm">Detail</a>

                                    <a href="{{ route('warga.edit', $item->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>

                                    <form action="{{ route('warga.destroy', $item->id) }}"
                                          method="POST"
                                          class="d-inline-block"
                                          onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>       
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-white py-3">
                                    Tidak Ada data di temukan 
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
>>>>>>> 8b8dcb9cb57b2425b848e3402d3634d98fcbe069
                </table>
            </div>

        </div>
    </div>

<<<<<<< HEAD
    <div class="d-flex justify-content-center mt-4">
    <nav>
        <ul class="pagination pagination-sm mb-0">

            {{-- PREV --}}
            <li class="page-item {{ $data->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $data->previousPageUrl() ?? '#' }}">
                    &laquo;
                </a>
            </li>

            {{-- NUMBER --}}
            @foreach ($data->getUrlRange(
                max(1, $data->currentPage() - 2),
                min($data->lastPage(), $data->currentPage() + 2)
            ) as $page => $url)
                <li class="page-item {{ $page == $data->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            {{-- NEXT --}}
            <li class="page-item {{ !$data->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $data->nextPageUrl() ?? '#' }}">
                    &raquo;
                </a>
            </li>

        </ul>
    </nav>
</div>

</div>
=======
    {{-- PAGINATION --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $data->appends(request()->all())->links() }}
    </div>

</div>
@include('layout.admin.footer')
>>>>>>> 8b8dcb9cb57b2425b848e3402d3634d98fcbe069

@include('layout.admin.footer')
@endsection
