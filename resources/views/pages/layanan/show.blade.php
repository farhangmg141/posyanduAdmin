@extends('layout.admin.master')

@section('content')
<div class="container mt-4">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Card Wrapper -->
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4 py-3 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="bi bi-clipboard-check"></i> Detail Layanan Posyandu
                    </h4>

                    <button class="btn btn-light btn-sm" onclick="copyID('{{ $item->layanan_id }}')">
                        <i class="bi bi-copy"></i> Copy ID
                    </button>
                </div>

                <div class="card-body p-4">

                    <table class="table table-borderless">
                        <tr>
                            <th class="text-secondary" width="30%">ID Layanan</th>
                            <td class="fw-bold">{{ $item->layanan_id }}</td>
                        </tr>

                        <tr>
                            <th class="text-secondary">Nama Warga</th>
                            <td>{{ $item->warga->nama }}</td>
                        </tr>

                        <tr>
                            <th class="text-secondary">Tanggal Kunjungan</th>
                            <td>{{ \Carbon\Carbon::parse($item->jadwal->tanggal)->format('d M Y') }}</td>
                        </tr>

                        <tr>
                            <th class="text-secondary">Berat Badan (BB)</th>
                            <td>{{ $item->berat }} kg</td>
                        </tr>

                        <tr>
                            <th class="text-secondary">Tinggi Badan (TB)</th>
                            <td>{{ $item->tinggi }} cm</td>
                        </tr>

                        <tr>
                            <th class="text-secondary">Jenis Vitamin</th>
                            <td>{{ $item->vitamin }}</td>
                        </tr>

                        <tr>
                            <th class="text-secondary">Konseling</th>
                            <td>{{ $item->konseling ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th class="text-secondary">Dibuat Pada</th>
                            <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    </table>
                </div>

                <div class="card-footer bg-light text-end rounded-bottom-4 py-3">
                    <a href="{{ route('layanan.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

            </div>

        </div>
    </div>

</div>
@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function copyID(id) {
    navigator.clipboard.writeText(id);
    Swal.fire({
        icon: 'success',
        title: 'ID Disalin!',
        text: 'ID Layanan berhasil disalin ke clipboard.',
        showConfirmButton: false,
        timer: 1500
    });
}
</script>
@endsection
