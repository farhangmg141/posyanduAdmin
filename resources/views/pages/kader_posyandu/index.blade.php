@extends('layout.admin.master')

@section('title', 'Data Kader Posyandu')

@section('content')
@include('layout.admin.css')

<div class="container-fluid py-4 animate-fadein">

    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <h2 class="text-beige fw-bold mb-3 mb-md-0">Data Kader Posyandu</h2>

        <a href="{{ route('kader.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle"></i> Tambah Kader
        </a>
    </div>

    {{-- Alert Sukses --}}
    @if (session('success'))
        <div class="alert alert-success d-none" id="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Filter & Search --}}
<div class="card shadow filter-card p-3 mb-4">
    <form method="GET" action="{{ route('kader.index') }}" id="filterForm">
        <div class="row g-3 align-items-end">

            <div class="col-md-3">
                <label class="text-white">Cari Kader</label>
                <input type="text" name="search" value="{{ request('search') }}"
                       class="form-control" placeholder="Nama kader">
            </div>

            <div class="col-md-3">
                <label class="text-white">Posyandu</label>
                <select name="posyandu" class="form-select">
                    <option value="">Semua Posyandu</option>
                    @foreach($posyanduList as $p)
                        <option value="{{ $p->posyandu_id }}"
                            {{ request('posyandu') == $p->posyandu_id ? 'selected' : '' }}>
                            {{ $p->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label class="text-white">Peran</label>
                <select name="peran" class="form-select">
                    <option value="">Semua</option>
                    @foreach(['Ketua','Sekretaris','Bendahara','Kader'] as $peran)
                        <option value="{{ $peran }}" {{ request('peran') == $peran ? 'selected' : '' }}>
                            {{ $peran }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label class="text-white">Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua</option>
                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-warning w-100">Filter</button>
                <a href="{{ route('kader.index') }}" class="btn btn-secondary w-100">Reset</a>
            </div>
        </div>

        {{-- 🔥 EXPORT BUTTON --}}
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="d-flex justify-content-end gap-2">

                    {{-- Export Excel --}}
                    <a href="{{ route('kader.export.excel') }}?{{ http_build_query(request()->query()) }}"
                       class="btn btn-success d-flex align-items-center gap-2">
                        <i class="bi bi-file-earmark-excel"></i> Export Excel
                    </a>

                    {{-- Export PDF --}}
                    <a href="{{ route('kader.export.pdf') }}?{{ http_build_query(request()->query()) }}"
                       class="btn btn-danger d-flex align-items-center gap-2">
                        <i class="bi bi-file-earmark-pdf"></i> Export PDF
                    </a>

                </div>
            </div>
        </div>
    </form>
</div>


    {{-- Card Table --}}
    <div class="card shadow-lg custom-card p-0 border-0">
        <div class="table-responsive">
            <table class="table table-bordered align-middle custom-table mb-0">
                <thead class="text-center">
                    <tr>
                        <th width="60">ID</th>
                        <th>Nama Kader</th>
                        <th>Posyandu</th>
                        <th>Peran</th>
                        <th>Mulai Tugas</th>
                        <th>Akhir Tugas</th>
                        <th>Status</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $item)
                        <tr>
                            <td class="text-center">{{ $item->kader_id }}</td>
                            <td>{{ $item->warga->nama ?? '-' }}</td>
                            <td>{{ $item->posyandu->nama ?? '-' }}</td>
                            <td class="text-center">
                                <span class="badge
                                    @if($item->peran == 'Ketua') bg-primary
                                    @elseif($item->peran == 'Sekretaris') bg-success
                                    @elseif($item->peran == 'Bendahara') bg-warning
                                    @else bg-secondary @endif">
                                    {{ $item->peran }}
                                </span>
                            </td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($item->mulai_tugas)->format('d/m/Y') }}
                            </td>
                            <td class="text-center">
                                {{ $item->akhir_tugas ? \Carbon\Carbon::parse($item->akhir_tugas)->format('d/m/Y') : '-' }}
                            </td>
                            <td class="text-center">
                                @if($item->akhir_tugas && \Carbon\Carbon::parse($item->akhir_tugas)->lt(now()))
                                    <span class="badge bg-danger">Nonaktif</span>
                                @else
                                    <span class="badge bg-success">Aktif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('kader.show', $item->kader_id) }}" class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('kader.edit', $item->kader_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('kader.destroy', $item->kader_id) }}"
                                          method="POST" class="form-hapus">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                Tidak ada data kader
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-3 px-3 pb-3">
        {{ $data->links('pagination::bootstrap-5') }}
    </div>

</div>

@include('layout.admin.footer')

{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll('.form-hapus').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data akan dihapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, hapus'
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
    });

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

{{-- CSS Konsisten --}}
<style>
.custom-card {
    background-color: #213830;
    border-radius: 10px;
}
.filter-card {
    background-color: #2b3a33;
    border-radius: 10px;
    border: 0;
}
.custom-table thead {
    background-color: #677D6A;
    color: #D6BD98;
}
.custom-table td, .custom-table th {
    border-color: #475749;
    color: white;
}
.custom-table tbody tr:hover {
    background-color: #2b3a33;
}
.pagination .page-link {
    background-color: #213830;
    border-color: #475749;
    color: #D6BD98;
}
.pagination .page-item.active .page-link {
    background-color: #677D6A;
    border-color: #677D6A;
    color: white;
}
</style>

@endsection
