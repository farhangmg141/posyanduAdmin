@extends('layout.admin.master')

@section('title', 'Kader Posyandu')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@include('layout.admin.css')

<div class="container-fluid mt-4">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Daftar Kader Posyandu</h2>
        <a href="{{ route('kader.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Kader
        </a>
    </div>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

   {{-- Card Filter dan Search --}}
<div class="card mb-4 border-0" style="background-color: #40534C;">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('kader.index') }}" id="filterForm">
            <div class="row g-2 align-items-center">
                {{-- Search --}}
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text" style="background-color: #677D6A; border-color: #677D6A; color: white;">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" class="form-control" style="border-color: #677D6A; background-color: #677D6A; color: white;" 
                               id="search" name="search" value="{{ request('search') }}" 
                               placeholder="Cari nama kader...">
                    </div>
                </div>
                    
                    {{-- Filter Posyandu --}}
                    <div class="col-md-2">
                        <select class="form-select" style="background-color: rgb(255, 255, 255); border-color: #677D6A; color: #333;" 
                                id="posyandu" name="posyandu">
                            <option value="">Semua Posyandu</option>
                            @foreach($posyanduList as $posyandu)
                                <option value="{{ $posyandu->posyandu_id }}" 
                                    {{ request('posyandu') == $posyandu->posyandu_id ? 'selected' : '' }}>
                                    {{ $posyandu->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filter Peran --}}
                    <div class="col-md-2">
                        <select class="form-select" style="background-color: rgb(255, 255, 255); border-color: #677D6A; color: #333;" 
                                id="peran" name="peran">
                            <option value="">Semua Peran</option>
                            <option value="Ketua" {{ request('peran') == 'Ketua' ? 'selected' : '' }}>Ketua</option>
                            <option value="Sekretaris" {{ request('peran') == 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                            <option value="Bendahara" {{ request('peran') == 'Bendahara' ? 'selected' : '' }}>Bendahara</option>
                            <option value="Kader" {{ request('peran') == 'Kader' ? 'selected' : '' }}>Kader</option>
                        </select>
                    </div>

                    {{-- Filter Status --}}
                    <div class="col-md-2">
                        <select class="form-select" style="background-color: rgb(247, 247, 247); border-color: #677D6A; color: #aca8a8;" 
                                id="status" name="status">
                            <option value="">Semua Status</option>
                            <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                    
                    {{-- Tombol Aksi --}}
                    <div class="col-md-3">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn flex-fill" style="background-color: #677D6A; border-color: #677D6A; color: white;">
                                <i class="fas fa-filter me-1"></i> Filter
                            </button>
                            <a href="{{ route('kader.index') }}" class="btn" style="background-color: white; border-color: #677D6A; color: #677D6A;">
                                <i class="fas fa-refresh"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                {{-- Export Buttons --}}
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('kader.export.excel') }}?{{ http_build_query(request()->query()) }}" 
                               class="btn" style="background-color: #28a745; border-color: #28a745; color: white;">
                                <i class="fas fa-file-excel me-1"></i> Export Excel
                            </a>
                            <a href="{{ route('kader.export.pdf') }}?{{ http_build_query(request()->query()) }}" 
                               class="btn" style="background-color: #dc3545; border-color: #dc3545; color: white;">
                                <i class="fas fa-file-pdf me-1"></i> Export PDF
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Card Tabel --}}
    <div class="card border-0" style="background-color: #40534C;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0" style="color: #f7f7f7;">
                    <thead>
                        <tr style="background-color: #677D6A;">
                            <th width="60" class="ps-3" style="color: white;">ID</th>
                            <th style="color: white;">NAMA KADER</th>
                            <th style="color: white;">POSYANDU</th>
                            <th style="color: white;">PERAN</th>
                            <th class="text-center" style="color: white;">MULAI TUGAS</th>
                            <th class="text-center" style="color: white;">AKHIR TUGAS</th>
                            <th class="text-center" style="color: white;">STATUS</th>
                            <th width="120" class="text-center pe-3" style="color: white;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $item)
                        <tr style="background-color:#40534C; border-bottom: 1px solid #070707;">
                            <td class="ps-3 fw-semibold">{{ $item->kader_id }}</td>
                            <td class="fw-medium">{{ $item->warga->nama ?? '-' }}</td>
                            <td>{{ $item->posyandu->nama ?? '-' }}</td>
                            <td>
                                <span class="badge 
                                    @if($item->peran == 'Ketua') bg-primary
                                    @elseif($item->peran == 'Sekretaris') bg-success
                                    @elseif($item->peran == 'Bendahara') bg-warning
                                    @else bg-secondary @endif">
                                    {{ $item->peran }}
                                </span>
                            </td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($item->mulai_tugas)->format('d/m/Y') }}</td>
                            <td class="text-center">
                                @if($item->akhir_tugas)
                                    {{ \Carbon\Carbon::parse($item->akhir_tugas)->format('d/m/Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">
                                @if($item->akhir_tugas && \Carbon\Carbon::parse($item->akhir_tugas)->lt(now()))
                                    <span class="badge bg-danger">Nonaktif</span>
                                @else
                                    <span class="badge bg-success">Aktif</span>
                                @endif
                            </td>
                            <td class="text-center pe-3">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('kader.show', $item->kader_id) }}" class="btn btn-sm px-2 py-1" 
                                       style="background-color: transparent; border-color: #17a2b8; color: #17a2b8;" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('kader.edit', $item->kader_id) }}" class="btn btn-sm px-2 py-1" 
                                       style="background-color: transparent; border-color: #ffc107; color: #ffc107;" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('kader.destroy', $item->kader_id) }}" method="POST" class="d-inline delete-form">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm px-2 py-1 btn-delete" 
                                                style="background-color: transparent; border-color: #dc3545; color: #dc3545;" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5" style="background-color: #40534C;">
                                <i class="fas fa-inbox fa-2x text-muted mb-3"></i>
                                <p class="text-muted mb-0">Tidak ada data kader ditemukan</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($data->hasPages())
            <div class="card-footer border-0" style="background-color: #40534C;">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="small" style="color: white;">
                        Menampilkan {{ $data->firstItem() ?? 0 }} - {{ $data->lastItem() ?? 0 }} dari {{ $data->total() }} data
                    </div>
                    <div>
                        {{ $data->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@include('layout.admin.footer')

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Konfirmasi hapus
    document.querySelectorAll('.btn-delete').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('.delete-form');
            
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Auto submit filter saat dropdown berubah
    const filterSelects = ['posyandu', 'peran', 'status'];
    filterSelects.forEach(selectId => {
        document.getElementById(selectId)?.addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    });
});
</script>

<style>
.table > :not(caption) > * > * {
    padding: 0.75rem 0.5rem;
}
.btn-sm {
    font-size: 0.75rem;
}
.card {
    border-radiu    s: 8px;
}

/* Custom Pagination Styles */
.pagination .page-link {
    background-color: white;
    border-color: #677D6A;
    color: #40534C;
}
.pagination .page-item.active .page-link {
    background-color: #677D6A;
    border-color: #677D6A;
    color: white;
}
.pagination .page-link:hover {
    background-color: #677D6A;
    border-color: #677D6A;
    color: white;
}
</style>

@endsection