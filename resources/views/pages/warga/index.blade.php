@extends('layout.admin.master')
@section('title', 'Data Warga')

@section('content')
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
                        placeholder="Cari nama / NIK / alamat..."
                        value="{{ request('search') }}">
                </div>

                {{-- Filter Jenis Kelamin --}}
                <div class="col-md-3">
                    <select name="jenis_kelamin" class="form-control"
                            style="background:#40534C; color:white; border-color:#677D6A;">
                        <option value="">-- Filter Jenis Kelamin --</option>
                        <option value="L" {{ request('jenis_kelamin')=='L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ request('jenis_kelamin')=='P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                {{-- Tombol --}}
                <div class="col-md-2">
                    <button class="btn w-100 fw-bold"
                        style="background-color:#D6BD98; color:#213830;">
                        Filter
                    </button>
                </div>

                {{-- Reset --}}
                <div class="col-md-2">
                    <a href="{{ route('warga.index') }}"
                        class="btn w-100 fw-bold"
                        style="background-color:#677D6A; color:white;">
                        Reset
                    </a>
                </div>

                {{-- Tambah Data --}}
                <div class="col-md-1 text-end">
                    <a href="{{ route('warga.create') }}" 
                        class="btn fw-bold"
                        style="background-color:#4CAF50; color:white;">
                       + Tambah 
                    </a>
                </div>

            </form>

        </div>
    </div>

    {{-- TABEL --}}
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
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($data as $item)
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
                </table>
            </div>

        </div>
    </div>

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $data->appends(request()->all())->links() }}
    </div>

</div>
@include('layout.admin.footer')

@endsection
