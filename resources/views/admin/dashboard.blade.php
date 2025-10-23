@extends('admin.layout.master')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid mt-4">
    <h1 class="mb-4 fw-bold text-krem">Dashboard Admin</h1>

    {{-- Kartu ringkasan --}}
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card-summary p-4 text-center">
                <div class="icon-wrapper mb-3">
                    <i class="bi bi-hospital-fill fs-1"></i>
                </div>
                <h6 class="text-uppercase text-muted-custom mb-2 fw-semibold">Total Posyandu</h6>
                <h2 class="fw-bold text-krem display-4 mb-2">{{ $totalPosyandu }}</h2>
                <p class="small text-putih-lembut mb-0">Data posyandu yang telah terdaftar</p>
            </div>
        </div>
    </div>

    {{-- Daftar Posyandu --}}
    <div class="card shadow-custom">
        <div class="card-header py-4">
            <h5 class="mb-0 text-krem fw-semibold">
                <i class="bi bi-list-ul me-2"></i> 
                Daftar Posyandu Terdaftar
            </h5>
        </div>

        <div class="card-body p-0">
            @if($dataPosyandu->isEmpty())
                <div class="alert-warning-custom text-center m-4">
                    <i class="bi bi-info-circle-fill me-2 fs-5"></i>
                    <span class="fw-medium">Belum ada data posyandu yang tersedia</span>
                </div>
            @else
                <div class="table-wrapper">
                    <table class="table table-custom align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 80px;">NO</th>
                                <th>NAMA POSYANDU</th>
                                <th>ALAMAT</th>
                                <th class="text-center" style="width: 120px;">RT/RW</th>
                                <th style="width: 150px;">KONTAK</th>
                                <th class="text-center" style="width: 120px;">FOTO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataPosyandu as $item)
                                <tr>
                                    <td class="text-center fw-semibold">{{ $loop->iteration }}</td>
                                    <td class="fw-medium">{{ $item->nama }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td class="text-center">{{ $item->rt }}/{{ $item->rw }}</td>
                                    <td>{{ $item->kontak }}</td>
                                    <td class="text-center">
                                        @if ($item->media)
                                            <img src="{{ asset('storage/'.$item->media) }}" 
                                                 alt="foto" 
                                                 class="img-table">
                                        @else
                                            <span class="badge-custom">Tidak ada</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- === CSS STYLE === --}}
<style>
/* 🎨 Palet utama */
:root {
    --gelap: #1A3636;
    --sekunder: #40534C;
    --lembut: #677D6A;
    --krem: #D6BD98;
    --putih-lembut: #F4F3EF;
}

/* 🌑 Umum */
body {
    background-color: var(--gelap);
    color: var(--putih-lembut);
    font-family: "Poppins", sans-serif;
}

/* ✨ Heading */
h1 {
    color: var(--krem);
    letter-spacing: 0.5px;
}

.text-krem {
    color: var(--krem) !important;
}

.text-putih-lembut {
    color: var(--putih-lembut) !important;
}

.text-muted-custom {
    color: rgba(214, 189, 152, 0.7) !important;
}

/* ✨ Card Summary */
.card-summary {
    background: linear-gradient(135deg, #40534C 0%, #677D6A 100%);
    border: 1px solid rgba(214, 189, 152, 0.2);
    border-radius: 12px;
    color: var(--krem);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}

.icon-wrapper {
    color: var(--krem);
    opacity: 0.9;
}

/* ✨ Card */
.card {
    background-color: #2d4540;
    border: 1px solid rgba(214, 189, 152, 0.15);
    border-radius: 12px;
    overflow: hidden;
}

.shadow-custom {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
}

.card-header {
    background: linear-gradient(135deg, #677D6A 0%, #5a6f5c 100%) !important;
    border-bottom: 2px solid rgba(214, 189, 152, 0.3);
}

.card-header h5 {
    color: var(--krem);
    letter-spacing: 0.5px;
}

.card-header i {
    color: var(--krem);
}

/* 🧾 Table Wrapper - hilangkan scrollbar */
.table-wrapper {
    overflow-x: auto;
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}

.table-wrapper::-webkit-scrollbar {
    display: none;  /* Chrome, Safari and Opera */
}

/* 🧾 Tabel */
.table-custom {
    width: 100%;
    color: var(--putih-lembut);
    border-collapse: collapse;
}

/* Header tabel */
.table-custom thead th {
    background: linear-gradient(135deg, #677D6A 0%, #5a6f5c 100%);
    color: var(--krem);
    font-weight: 600;
    font-size: 0.75rem;
    letter-spacing: 1px;
    padding: 16px 12px;
    border: none;
    position: sticky;
    top: 0;
    z-index: 10;
}

/* Isi tabel */
.table-custom tbody tr {
    background-color: #40534C;
    border-bottom: 1px solid rgba(214, 189, 152, 0.1);
}

.table-custom tbody tr:nth-child(even) {
    background-color: #3a4c47;
}

.table-custom tbody td {
    padding: 16px 12px;
    color: var(--putih-lembut);
    border: none;
    vertical-align: middle;
}

/* Hover efek - tetap kelihatan teksnya */
.table-custom tbody tr:hover {
    background-color: #4d6159 !important;
}

/* Saat baris diklik - tetap kelihatan teksnya */
.table-custom tbody tr:active,
.table-custom tbody tr:focus {
    background-color: #5a6f65 !important;
    outline: 1px solid rgba(214, 189, 152, 0.3);
}

.table-custom tbody tr:focus-visible {
    box-shadow: none;
}

/* 🔗 Link di dalam tabel */
.table-custom tbody tr a {
    color: var(--krem);
    text-decoration: none;
}

.table-custom tbody tr a:hover {
    color: #ffffff;
    text-decoration: underline;
}

/* 📷 Gambar tabel */
.img-table {
    width: 55px;
    height: 55px;
    object-fit: cover;
    border-radius: 50%;
    border: 2px solid var(--krem);
}

/* Badge */
.badge-custom {
    background-color: #5a6f5c;
    color: var(--putih-lembut);
    padding: 6px 14px;
    border-radius: 6px;
    font-size: 0.7rem;
    font-weight: 500;
    display: inline-block;
}

/* ⚠️ Alert custom */
.alert-warning-custom {
    background-color: rgba(103, 125, 106, 0.25);
    border: 1px solid rgba(214, 189, 152, 0.3);
    color: var(--krem);
    border-radius: 10px;
    padding: 20px;
}

.alert-warning-custom i {
    color: var(--krem);
    vertical-align: middle;
}

/* 📋 Input dan Form */
.form-control {
    background-color: #2d4540;
    color: var(--putih-lembut);
    border: 1px solid rgba(214, 189, 152, 0.2);
    border-radius: 8px;
}

.form-control:focus {
    background-color: #3a4c47;
    color: #ffffff;
    border-color: var(--krem);
    box-shadow: 0 0 0 0.2rem rgba(214, 189, 152, 0.15);
}

.form-control::placeholder {
    color: rgba(244, 243, 239, 0.5);
}

/* 📱 Responsive */
@media (max-width: 768px) {
    .table-custom {
        font-size: 0.85rem;
    }
    
    .table-custom thead th {
        padding: 12px 8px;
        font-size: 0.7rem;
    }
    
    .table-custom tbody td {
        padding: 12px 8px;
    }
    
    .img-table {
        width: 45px;
        height: 45px;
    }
    
    h1 {
        font-size: 1.75rem;
    }
}

@media (max-width: 576px) {
    .card-summary {
        margin-bottom: 15px;
    }
}
</style>

@endsection