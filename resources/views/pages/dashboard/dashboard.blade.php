@extends('layout.admin.master')



@section('content')
<div class="container-fluid mt-4 px-4">
    <!-- Header Section dengan Animasi -->
    <div class="mb-5 fade-in-up">
        <h1 class="fw-bold mb-2 display-5" style="color: #f5f5f5; text-shadow: 1px 1px 3px rgba(255, 255, 255, 0.89);">Dashboard Admin</h1>
        <p class="fs-5" style="color: #ffffff;">Selamat datang di sistem manajemen Posyandu</p>
    </div>

    {{-- 📊 Ringkasan Data dengan Gradient Cards & Animasi --}}
    <div class="row g-4 mb-5">
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-lg h-100 position-relative overflow-hidden card-hover card-animate" style="background: linear-gradient(135deg, #0d3c3c 0%, #1a5252 100%);">
                <div class="card-body text-white p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="mb-1 text-white-50 fw-semibold" style="font-size: 0.9rem; letter-spacing: 0.5px;">Total Posyandu</p>
                            <h2 class="fw-bold mb-0 text-white display-4" style="text-shadow: 1px 1px 4px rgba(0,0,0,0.2); font-size: 2.5rem;">{{ $totalPosyandu }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-3 p-3 icon-float">
                            <i class="bi bi-hospital-fill fs-2 text-white"></i>
                        </div>
                    </div>
                    <div class="progress" style="height: 5px; background-color: rgba(255,255,255,0.2);">
                        <div class="progress-bar bg-white progress-bar-animate" style="width: 75%;"></div>
                    </div>
                    <small class="text-white-50 fw-medium mt-2 d-block" style="font-size: 0.8rem;">
                        <i class="bi bi-graph-up-arrow me-1"></i>Aktif dan Terdaftar
                    </small>
                </div>
                <div class="card-wave"></div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-lg h-100 position-relative overflow-hidden card-hover card-animate" style="background: linear-gradient(135deg, #3d5a4d 0%, #4a6b5c 100%); animation-delay: 0.1s;">
                <div class="card-body text-white p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="mb-1 text-white-50 fw-semibold" style="font-size: 0.9rem; letter-spacing: 0.5px;">Total Kader</p>
                            <h2 class="fw-bold mb-0 text-white display-4" style="text-shadow: 1px 1px 4px rgba(0,0,0,0.2); font-size: 2.5rem;">{{ $totalKader }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-3 p-3 icon-float">
                            <i class="bi bi-people-fill fs-2 text-white"></i>
                        </div>
                    </div>
                    <div class="progress" style="height: 5px; background-color: rgba(255,255,255,0.2);">
                        <div class="progress-bar bg-white progress-bar-animate" style="width: 85%; animation-delay: 0.1s;"></div>
                    </div>
                    <small class="text-white-50 fw-medium mt-2 d-block" style="font-size: 0.8rem;">
                        <i class="bi bi-people me-1"></i>Kader Aktif Bertugas
                    </small>
                </div>
                <div class="card-wave"></div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-lg h-100 position-relative overflow-hidden card-hover card-animate" style="background: linear-gradient(135deg, #6a8b76 0%, #7a9b85 100%); animation-delay: 0.2s;">
                <div class="card-body text-white p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="mb-1 text-white-50 fw-semibold" style="font-size: 0.9rem; letter-spacing: 0.5px;">Total Jadwal</p>
                            <h2 class="fw-bold mb-0 text-white display-4" style="text-shadow: 1px 1px 4px rgba(0,0,0,0.2); font-size: 2.5rem;">{{ $totalJadwal }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-3 p-3 icon-float">
                            <i class="bi bi-calendar-event-fill fs-2 text-white"></i>
                        </div>
                    </div>
                    <div class="progress" style="height: 5px; background-color: rgba(255,255,255,0.2);">
                        <div class="progress-bar bg-white progress-bar-animate" style="width: 60%; animation-delay: 0.2s;"></div>
                    </div>
                    <small class="text-white-50 fw-medium mt-2 d-block" style="font-size: 0.8rem;">
                        <i class="bi bi-calendar-check me-1"></i>Jadwal Terjadwal
                    </small>
                </div>
                <div class="card-wave"></div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-lg h-100 position-relative overflow-hidden card-hover card-animate" style="background: linear-gradient(135deg, #c4a87c 0%, #d4b896 100%); animation-delay: 0.3s;">
                <div class="card-body text-white p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="mb-1 text-white-50 fw-semibold" style="font-size: 0.9rem; letter-spacing: 0.5px;">Total Layanan</p>
                            <h2 class="fw-bold mb-0 text-white display-4" style="text-shadow: 1px 1px 4px rgba(0,0,0,0.2); font-size: 2.5rem;">{{ $totalLayanan }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-3 p-3 icon-float">
                            <i class="bi bi-clipboard2-pulse-fill fs-2 text-white"></i>
                        </div>
                    </div>
                    <div class="progress" style="height: 5px; background-color: rgba(255,255,255,0.2);">
                        <div class="progress-bar bg-white progress-bar-animate" style="width: 90%; animation-delay: 0.3s;"></div>
                    </div>
                    <small class="text-white-50 fw-medium mt-2 d-block" style="font-size: 0.8rem;">
                        <i class="bi bi-heart-pulse me-1"></i>Layanan Tercatat
                    </small>
                </div>
                <div class="card-wave"></div>
            </div>
        </div>
    </div>

    {{-- 📊 Grafik Statistik --}}
    <div class="row g-4 mb-5">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg card-hover card-animate" style="animation-delay: 0.4s; background: #ffffff;">
                <div class="card-header border-0 py-4" style="background: linear-gradient(90deg, #0d3c3c 0%, #1a5252 100%); border-radius: 10px 10px 0 0;">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 rounded-3 p-2 me-3">
                            <i class="bi bi-bar-chart-fill fs-4 text-white"></i>
                        </div>
                        <h5 class="mb-0 text-white fw-bold" style="font-size: 1.1rem; letter-spacing: 0.5px;">Statistik Layanan Bulanan</h5>
                    </div>
                </div>
                <div class="card-body p-4" style="background: #d6d6d6;">
                    <canvas id="layananChart" height="80"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-lg h-100 card-hover card-animate" style="animation-delay: 0.5s; background: #ffffff;">
                <div class="card-header border-0 py-4" style="background: linear-gradient(90deg, #3d5a4d 0%, #4a6b5c 100%); border-radius: 10px 10px 0 0;">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 rounded-3 p-2 me-3">
                            <i class="bi bi-pie-chart-fill fs-4 text-white"></i>
                        </div>
                        <h5 class="mb-0 text-white fw-bold" style="font-size: 1.1rem; letter-spacing: 0.5px;">Distribusi Data</h5>
                    </div>
                </div>
                <div class="card-body p-4" style="background: #c5c5c5;">
                    <canvas id="distribusiChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- 📅 Jadwal Posyandu Terbaru --}}
    <div class="card border-0 shadow-lg mb-4 card-hover card-animate" style="animation-delay: 0.6s; background: #ffffff; border-radius: 10px;">
        <div class="card-header border-0 py-4" style="background: linear-gradient(90deg, #0d3c3c 0%, #1a5252 100%); border-radius: 10px 10px 0 0;">
            <div class="d-flex align-items-center">
                <div class="bg-white bg-opacity-20 rounded-3 p-2 me-3">
                    <i class="bi bi-calendar-event fs-4 text-white"></i>
                </div>
                <h5 class="mb-0 text-white fw-bold" style="font-size: 1.1rem; letter-spacing: 0.5px;">Jadwal Posyandu Terbaru</h5>
            </div>
        </div>
        <div class="card-body p-0" style="background: #0d3c3c;">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr style="background: linear-gradient(90deg, #0d3c3c 0%, #1a5252 100%);">
                            <th class="border-0 py-3 px-4 text-white fw-bold" style="font-size: 0.95rem; letter-spacing: 0.5px;">Tanggal</th>
                            <th class="border-0 py-3 px-4 text-white fw-bold" style="font-size: 0.95rem; letter-spacing: 0.5px;">Posyandu</th>
                            <th class="border-0 py-3 px-4 text-white fw-bold" style="font-size: 0.95rem; letter-spacing: 0.5px;">Tema</th>
                            <th class="border-0 py-3 px-4 text-white fw-bold" style="font-size: 0.95rem; letter-spacing: 0.5px;">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataJadwal as $jadwal)
                        <tr class="table-row-hover">
                            <td class="px-4 py-3">
                                <span class="badge rounded-pill px-3 py-1 text-white fw-medium" style="background: linear-gradient(135deg, #6a8b76 0%, #7a9b85 100%); font-size: 0.85rem; letter-spacing: 0.3px;">
                                    <i class="bi bi-calendar3 me-2"></i>
                                    {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <strong style="color: #0d3c3c; font-size: 0.95rem; font-weight: 600;">
                                    {{ $jadwal->posyandu->nama ?? '-' }}
                                </strong>
                            </td>
                            <td class="px-4 py-3">
                                <span style="color: #2d2d2d; font-weight: 500; font-size: 0.9rem;">{{ $jadwal->tema }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span style="color: #5a5a5a; font-weight: 400; font-size: 0.85rem;">{{ $jadwal->keterangan ?? '-' }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 d-block mb-3" style="color: #6a8b76;"></i>
                                <p class="mb-0 fw-medium" style="color: #3d5a4d; font-size: 0.95rem;">Belum ada data jadwal</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        {{-- 👩‍⚕️ Kader Posyandu Terbaru --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg h-100 card-hover card-animate" style="animation-delay: 0.7s; background: #ffffff; border-radius: 10px;">
                <div class="card-header border-0 py-4" style="background: linear-gradient(90deg, #3d5a4d 0%, #4a6b5c 100%); border-radius: 10px 10px 0 0;">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 rounded-3 p-2 me-3">
                            <i class="bi bi-person-badge fs-4 text-white"></i>
                        </div>
                        <h5 class="mb-0 text-white fw-bold" style="font-size: 1.1rem; letter-spacing: 0.5px;">Kader Posyandu Terbaru</h5>
                    </div>
                </div>
                <div class="card-body p-0" style="background: #0d3c3c;">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr style="background: linear-gradient(90deg, #3d5a4d 0%, #4a6b5c 100%);">
                                    <th class="border-0 py-3 px-4 text-white fw-bold" style="font-size: 0.95rem; letter-spacing: 0.5px;">Nama Warga</th>
                                    <th class="border-0 py-3 px-4 text-white fw-bold" style="font-size: 0.95rem; letter-spacing: 0.5px;">Posyandu</th>
                                    <th class="border-0 py-3 px-4 text-white fw-bold" style="font-size: 0.95rem; letter-spacing: 0.5px;">Peran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dataKader as $kader)
                                <tr class="table-row-hover">
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3 avatar-bounce"
                                                style="width: 40px; height: 40px; background: linear-gradient(135deg, #6a8b76 0%, #7a9b85 100%); color: white; font-weight: 600; font-size: 1rem;">
                                                {{ substr($kader->warga->nama ?? 'N', 0, 1) }}
                                            </div>
                                            <strong style="color: #0d3c3c; font-size: 0.95rem; font-weight: 600;">{{ $kader->warga->nama ?? '-' }}</strong>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span style="color: #2d2d2d; font-weight: 500; font-size: 0.9rem;">{{ $kader->posyandu->nama ?? '-' }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge rounded-pill px-3 py-1 text-white fw-medium" style="background: linear-gradient(135deg, #c4a87c 0%, #d4b896 100%); font-size: 0.85rem; letter-spacing: 0.3px;">
                                            <i class="bi bi-award me-1"></i>{{ $kader->peran }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5">
                                        <i class="bi bi-inbox fs-1 d-block mb-3" style="color: #6a8b76;"></i>
                                        <p class="mb-0 fw-medium" style="color: #3d5a4d; font-size: 0.95rem;">Belum ada data kader</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- 🧾 Layanan Posyandu Terbaru --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg h-100 card-hover card-animate" style="animation-delay: 0.8s; background: #ffffff; border-radius: 10px;">
                <div class="card-header border-0 py-4" style="background: linear-gradient(90deg, #6a8b76 0%, #7a9b85 100%); border-radius: 10px 10px 0 0;">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 rounded-3 p-2 me-3">
                            <i class="bi bi-clipboard2-pulse fs-4 text-white"></i>
                        </div>
                        <h5 class="mb-0 text-white fw-bold" style="font-size: 1.1rem; letter-spacing: 0.5px;">Layanan Posyandu Terbaru</h5>
                    </div>
                </div>
                <div class="card-body p-0" style="background: #0d3c3c;">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr style="background: linear-gradient(90deg, #6a8b76 0%, #7a9b85 100%);">
                                    <th class="border-0 py-3 px-4 text-white fw-bold" style="font-size: 0.95rem; letter-spacing: 0.5px;">Nama Warga</th>
                                    <th class="border-0 py-3 px-4 text-white fw-bold" style="font-size: 0.95rem; letter-spacing: 0.5px;">Berat (kg)</th>
                                    <th class="border-0 py-3 px-4 text-white fw-bold" style="font-size: 0.95rem; letter-spacing: 0.5px;">Tinggi (cm)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dataLayanan as $layanan)
                                <tr class="table-row-hover">
                                    <td class="px-4 py-3">
                                        <strong style="color: #0d3c3c; font-size: 0.95rem; font-weight: 600;">{{ $layanan->warga->nama ?? '-' }}</strong>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($layanan->berat)
                                        <span class="badge rounded-pill px-3 py-1 text-white fw-medium" style="background: linear-gradient(135deg, #3d5a4d 0%, #4a6b5c 100%); font-size: 0.85rem; letter-spacing: 0.3px;">
                                            <i class="bi bi-activity me-1"></i>{{ $layanan->berat }} kg
                                        </span>
                                        @else
                                        <span style="color: #999999; font-weight: 400; font-size: 0.85rem;">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($layanan->tinggi)
                                        <span class="badge rounded-pill px-3 py-1 text-white fw-medium" style="background: linear-gradient(135deg, #c4a87c 0%, #d4b896 100%); font-size: 0.85rem; letter-spacing: 0.3px;">
                                            <i class="bi bi-arrows-vertical me-1"></i>{{ $layanan->tinggi }} cm
                                        </span>
                                        @else
                                        <span style="color: #999999; font-weight: 400; font-size: 0.85rem;">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5">
                                        <i class="bi bi-inbox fs-1 d-block mb-3" style="color: #6a8b76;"></i>
                                        <p class="mb-0 fw-medium" style="color: #3d5a4d; font-size: 0.95rem;">Belum ada data layanan</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- CSS Styles langsung di dalam file --}}
<style>
    :root {
        --primary-dark: #0d3c3c;
        --primary: #1a5252;
        --secondary-dark: #3d5a4d;
        --secondary: #4a6b5c;
        --accent-green: #6a8b76;
        --accent-light-green: #7a9b85;
        --accent-beige: #c4a87c;
        --accent-light-beige: #d4b896;
        --background-light: #f8faf9;
        --text-dark: #2d2d2d;
        --text-medium: #5a5a5a;
        --text-light: #999999;
        --white: #949494;
        --shadow-light: rgba(0, 0, 0, 0.05);
        --shadow-medium: rgba(0, 0, 0, 0.1);
    }
    
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: var(--background-light);
        color: var(--text-dark);
        font-size: 14px;
    }
    
    /* Animasi umum */
    .fade-in-up {
        animation: fadeInUp 0.8s ease-out;
    }
    
    .card-animate {
        animation: fadeInUp 0.6s ease-out;
        animation-fill-mode: both;
    }
    
    .card-hover {
        transition: all 0.3s ease;
    }
    
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
    
    .table-row-hover:hover {
        background-color: rgba(13, 60, 60, 0.03) !important;
    }
    
    /* Animasi ikon */
    .icon-float {
        animation: float 3s ease-in-out infinite;
    }
    
    .avatar-bounce {
        animation: bounce 2s ease-in-out infinite;
    }
    
    .progress-bar-animate {
        animation: progressAnimation 1.5s ease-out;
    }
    
    /* Wave effect untuk cards */
    .card-wave {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 10px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        animation: wave 2s linear infinite;
        opacity: 0.5;
    }
    
    /* Keyframes */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }
    
    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-5px);
        }
    }
    
    @keyframes progressAnimation {
        from {
            width: 0%;
        }
        to {
            width: attr(data-width);
        }
    }
    
    @keyframes wave {
        0% {
            transform: translateX(-100%);
        }
        100% {
            transform: translateX(100%);
        }
    }
    
    /* Perbaikan tipografi */
    h1, h2, h3, h4, h5, h6 {
        font-weight: 600;
        letter-spacing: 0.3px;
    }
    
    .card-header {
        font-weight: 600;
        letter-spacing: 0.3px;
    }
    
    /* Table styling */
    .table {
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .table th {
        font-weight: 600;
        border: none;
    }
    
    .table td {
        vertical-align: middle;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .table tbody tr:last-child td {
        border-bottom: none;
    }
    
    /* Badge styling */
    .badge {
        font-weight: 500;
        letter-spacing: 0.3px;
    }
</style>

{{-- JavaScript langsung di dalam file --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set delay untuk animasi cards
        const cards = document.querySelectorAll('.card-animate');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
        
        // Inisialisasi Chart.js
        initializeCharts();
        
        // Tambahkan event listener untuk hover effects
        const cardHovers = document.querySelectorAll('.card-hover');
        cardHovers.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transition = 'all 0.3s ease';
            });
        });
        
        // Update progress bars dengan data dinamis
        updateProgressBars();
        
        // Tambahkan efek ripple pada tombol/icon
        addRippleEffects();
    });
    
    function initializeCharts() {
        // Chart Statistik Layanan Bulanan
        const layananCtx = document.getElementById('layananChart').getContext('2d');
        const layananChart = new Chart(layananCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Jumlah Layanan',
                    data: [65, 78, 90, 85, 70, 88, 95, 80, 92, 85, 90, 95],
                    borderColor: '#0d3c3c',
                    backgroundColor: 'rgba(13, 60, 60, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: '#0d3c3c',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(13, 60, 60, 0.9)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: '#ffffff',
                        borderWidth: 1,
                        cornerRadius: 5
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            color: '#5a5a5a'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            color: '#5a5a5a'
                        }
                    }
                }
            }
        });
        
        // Chart Distribusi Data
        const distribusiCtx = document.getElementById('distribusiChart').getContext('2d');
        const distribusiChart = new Chart(distribusiCtx, {
            type: 'doughnut',
            data: {
                labels: ['Posyandu', 'Kader', 'Jadwal', 'Layanan'],
                datasets: [{
                    data: [
                        {{ $totalPosyandu ?? 0 }},
                        {{ $totalKader ?? 0 }},
                        {{ $totalJadwal ?? 0 }},
                        {{ $totalLayanan ?? 0 }}
                    ],
                    backgroundColor: [
                        '#0d3c3c',
                        '#3d5a4d',
                        '#6a8b76',
                        '#c4a87c'
                    ],
                    borderColor: '#ffffff',
                    borderWidth: 2,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            color: '#5a5a5a',
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(13, 60, 60, 0.9)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: '#ffffff',
                        borderWidth: 1,
                        cornerRadius: 5
                    }
                }
            }
        });
        
        // Simpan referensi chart untuk digunakan nanti
        window.layananChart = layananChart;
        window.distribusiChart = distribusiChart;
    }
    
    function updateProgressBars() {
        const progressBars = document.querySelectorAll('.progress-bar-animate');
        progressBars.forEach((bar, index) => {
            // Atur width berdasarkan index (hanya untuk demo)
            const widths = ['75%', '85%', '60%', '90%'];
            if (index < widths.length) {
                bar.style.width = widths[index];
            }
        });
    }
    
    function addRippleEffects() {
        // Tambahkan efek ripple pada icon
        const icons = document.querySelectorAll('.icon-float, .avatar-bounce');
        icons.forEach(icon => {
            icon.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.5);
                    transform: scale(0);
                    animation: ripple-animation 0.6s linear;
                    width: ${size}px;
                    height: ${size}px;
                    top: ${y}px;
                    left: ${x}px;
                    pointer-events: none;
                `;
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    }
    
    // Tambahkan style untuk ripple animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
    
    // Fungsi untuk refresh data (jika diperlukan)
    function refreshDashboardData() {
        console.log('Refreshing dashboard data...');
        // Di sini bisa ditambahkan logika untuk mengambil data terbaru dari server
    }
    
    // Auto-refresh setiap 5 menit (opsional)
    // setInterval(refreshDashboardData, 300000);
</script>

@include('layout.admin.footer')
@endsection