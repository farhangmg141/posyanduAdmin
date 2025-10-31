@extends('layout.admin.master')

@section('title', 'Dashboard Admin')

@include('layout.admin.css')

@section('content')
<div class="container-fluid mt-4 px-4">
    <!-- Header Section dengan Animasi -->
    <div class="mb-5 fade-in">
        <h1 class="fw-bold mb-2 display-4" style="color: #1a4d4d; text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">Dashboard Admin</h1>
        <p class="fs-5" style="color: #4a6b5c;">Selamat datang di sistem manajemen Posyandu</p>
    </div>

    {{-- 📊 Ringkasan Data dengan Gradient Cards & Animasi --}}
    <div class="row g-4 mb-5">
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-lg h-100 position-relative overflow-hidden card-animate" style="background: linear-gradient(135deg, #1a4d4d 0%, #2d6363 100%);">
                <div class="card-body text-white p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="mb-1 text-white fw-semibold" style="font-size: 0.95rem; letter-spacing: 0.5px;">Total Posyandu</p>
                            <h2 class="fw-bold mb-0 text-white display-4" style="text-shadow: 2px 2px 6px rgba(0,0,0,0.3);">{{ $totalPosyandu }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-3 p-3 icon-pulse">
                            <i class="bi bi-hospital-fill fs-2 text-white"></i>
                        </div>
                    </div>
                    <div class="progress" style="height: 6px; background-color: rgba(255,255,255,0.3);">
                        <div class="progress-bar bg-white progress-animate" style="width: 75%; box-shadow: 0 2px 8px rgba(255,255,255,0.4);"></div>
                    </div>
                    <small class="text-white fw-semibold mt-2 d-block" style="font-size: 0.85rem;">
                        <i class="bi bi-graph-up-arrow me-1"></i>Aktif dan Terdaftar
                    </small>
                </div>
                <div class="card-glow"></div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-lg h-100 position-relative overflow-hidden card-animate" style="background: linear-gradient(135deg, #4a6b5c 0%, #5d7f6f 100%); animation-delay: 0.1s;">
                <div class="card-body text-white p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="mb-1 text-white fw-semibold" style="font-size: 0.95rem; letter-spacing: 0.5px;">Total Kader</p>
                            <h2 class="fw-bold mb-0 text-white display-4" style="text-shadow: 2px 2px 6px rgba(0,0,0,0.3);">{{ $totalKader }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-3 p-3 icon-pulse">
                            <i class="bi bi-people-fill fs-2 text-white"></i>
                        </div>
                    </div>
                    <div class="progress" style="height: 6px; background-color: rgba(255,255,255,0.3);">
                        <div class="progress-bar bg-white progress-animate" style="width: 85%; animation-delay: 0.1s; box-shadow: 0 2px 8px rgba(255,255,255,0.4);"></div>
                    </div>
                    <small class="text-white fw-semibold mt-2 d-block" style="font-size: 0.85rem;">
                        <i class="bi bi-people me-1"></i>Kader Aktif Bertugas
                    </small>
                </div>
                <div class="card-glow"></div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-lg h-100 position-relative overflow-hidden card-animate" style="background: linear-gradient(135deg, #7a9b85 0%, #8dad98 100%); animation-delay: 0.2s;">
                <div class="card-body text-white p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="mb-1 text-white fw-semibold" style="font-size: 0.95rem; letter-spacing: 0.5px;">Total Jadwal</p>
                            <h2 class="fw-bold mb-0 text-white display-4" style="text-shadow: 2px 2px 6px rgba(0,0,0,0.3);">{{ $totalJadwal }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-3 p-3 icon-pulse">
                            <i class="bi bi-calendar-event-fill fs-2 text-white"></i>
                        </div>
                    </div>
                    <div class="progress" style="height: 6px; background-color: rgba(255,255,255,0.3);">
                        <div class="progress-bar bg-white progress-animate" style="width: 60%; animation-delay: 0.2s; box-shadow: 0 2px 8px rgba(255,255,255,0.4);"></div>
                    </div>
                    <small class="text-white fw-semibold mt-2 d-block" style="font-size: 0.85rem;">
                        <i class="bi bi-calendar-check me-1"></i>Jadwal Terjadwal
                    </small>
                </div>
                <div class="card-glow"></div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-lg h-100 position-relative overflow-hidden card-animate" style="background: linear-gradient(135deg, #d4b896 0%, #e0c9a9 100%); animation-delay: 0.3s;">
                <div class="card-body text-white p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="mb-1 text-white fw-semibold" style="font-size: 0.95rem; letter-spacing: 0.5px;">Total Layanan</p>
                            <h2 class="fw-bold mb-0 text-white display-4" style="text-shadow: 2px 2px 6px rgba(0,0,0,0.3);">{{ $totalLayanan }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-3 p-3 icon-pulse">
                            <i class="bi bi-clipboard2-pulse-fill fs-2 text-white"></i>
                        </div>
                    </div>
                    <div class="progress" style="height: 6px; background-color: rgba(255,255,255,0.3);">
                        <div class="progress-bar bg-white progress-animate" style="width: 90%; animation-delay: 0.3s; box-shadow: 0 2px 8px rgba(255,255,255,0.4);"></div>
                    </div>
                    <small class="text-white fw-semibold mt-2 d-block" style="font-size: 0.85rem;">
                        <i class="bi bi-heart-pulse me-1"></i>Layanan Tercatat
                    </small>
                </div>
                <div class="card-glow"></div>
            </div>
        </div>
    </div>

    {{-- 📊 Grafik Statistik --}}
    <div class="row g-4 mb-5">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg card-animate" style="animation-delay: 0.4s; background: #ffffff;">
                <div class="card-header border-0 py-4" style="background: linear-gradient(90deg, #1a4d4d 0%, #2d6363 100%);">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-25 rounded-3 p-2 me-3">
                            <i class="bi bi-bar-chart-fill fs-4 text-white"></i>
                        </div>
                        <h5 class="mb-0 text-white fw-bold" style="font-size: 1.1rem; letter-spacing: 0.5px;">Statistik Layanan Bulanan</h5>
                    </div>
                </div>
                <div class="card-body p-4" style="background: #ffffff;">
                    <canvas id="layananChart" height="80"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-lg h-100 card-animate" style="animation-delay: 0.5s; background: #ffffff;">
                <div class="card-header border-0 py-4" style="background: linear-gradient(90deg, #4a6b5c 0%, #5d7f6f 100%);">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-25 rounded-3 p-2 me-3">
                            <i class="bi bi-pie-chart-fill fs-4 text-white"></i>
                        </div>
                        <h5 class="mb-0 text-white fw-bold" style="font-size: 1.1rem; letter-spacing: 0.5px;">Distribusi Data</h5>
                    </div>
                </div>
                <div class="card-body p-4" style="background: #ffffff;">
                    <canvas id="distribusiChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- 📅 Jadwal Posyandu Terbaru --}}
    <div class="card border-0 shadow-lg mb-4 card-animate" style="animation-delay: 0.6s; background: #ffffff; border-radius: 12px;">
        <div class="card-header border-0 py-4" style="background: linear-gradient(90deg, #1a4d4d 0%, #2d6363 100%); border-radius: 12px 12px 0 0;">
            <div class="d-flex align-items-center">
                <div class="bg-white bg-opacity-25 rounded-3 p-2 me-3">
                    <i class="bi bi-calendar-event fs-4 text-white"></i>
                </div>
                <h5 class="mb-0 text-white fw-bold" style="font-size: 1.1rem; letter-spacing: 0.5px;">Jadwal Posyandu Terbaru</h5>
            </div>
        </div>
        <div class="card-body p-0" style="background: #ffffff;">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr style="background: linear-gradient(90deg, #1a4d4d 0%, #2d6363 100%);">
                            <th class="border-0 py-4 px-4 text-white fw-bold" style="font-size: 1rem; letter-spacing: 0.5px;">Tanggal</th>
                            <th class="border-0 py-4 px-4 text-white fw-bold" style="font-size: 1rem; letter-spacing: 0.5px;">Posyandu</th>
                            <th class="border-0 py-4 px-4 text-white fw-bold" style="font-size: 1rem; letter-spacing: 0.5px;">Tema</th>
                            <th class="border-0 py-4 px-4 text-white fw-bold" style="font-size: 1rem; letter-spacing: 0.5px;">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataJadwal as $jadwal)
                        <tr class="table-row-hover">
                            <td class="px-4 py-4">
                                <span class="badge rounded-pill px-4 py-2 text-white fw-bold" style="background: linear-gradient(135deg, #7a9b85 0%, #8dad98 100%); font-size: 0.9rem; letter-spacing: 0.3px; box-shadow: 0 4px 8px rgba(122,155,133,0.3);">
                                    <i class="bi bi-calendar3 me-2"></i>
                                    {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                <strong style="color: #1a4d4d; font-size: 1rem; font-weight: 700;">
                                    {{ $jadwal->posyandu->nama ?? '-' }}
                                </strong>
                            </td>
                            <td class="px-4 py-4">
                                <span style="color: #2d2d2d; font-weight: 600; font-size: 0.95rem;">{{ $jadwal->tema }}</span>
                            </td>
                            <td class="px-4 py-4">
                                <span style="color: #5a5a5a; font-weight: 500; font-size: 0.9rem;">{{ $jadwal->keterangan ?? '-' }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 d-block mb-3" style="color: #7a9b85;"></i>
                                <p class="mb-0 fw-semibold" style="color: #4a6b5c; font-size: 1rem;">Belum ada data jadwal</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- 👩‍⚕️ Kader Posyandu Terbaru --}}
    <div class="card border-0 shadow-lg mb-4 card-animate" style="animation-delay: 0.7s; background: #ffffff; border-radius: 12px;">
        <div class="card-header border-0 py-4" style="background: linear-gradient(90deg, #4a6b5c 0%, #5d7f6f 100%); border-radius: 12px 12px 0 0;">
            <div class="d-flex align-items-center">
                <div class="bg-white bg-opacity-25 rounded-3 p-2 me-3">
                    <i class="bi bi-person-badge fs-4 text-white"></i>
                </div>
                <h5 class="mb-0 text-white fw-bold" style="font-size: 1.1rem; letter-spacing: 0.5px;">Kader Posyandu Terbaru</h5>
            </div>
        </div>
        <div class="card-body p-0" style="background: #ffffff;">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr style="background: linear-gradient(90deg, #4a6b5c 0%, #5d7f6f 100%);">
                            <th class="border-0 py-4 px-4 text-white fw-bold" style="font-size: 1rem; letter-spacing: 0.5px;">Nama Warga</th>
                            <th class="border-0 py-4 px-4 text-white fw-bold" style="font-size: 1rem; letter-spacing: 0.5px;">Posyandu</th>
                            <th class="border-0 py-4 px-4 text-white fw-bold" style="font-size: 1rem; letter-spacing: 0.5px;">Peran</th>
                            <th class="border-0 py-4 px-4 text-white fw-bold" style="font-size: 1rem; letter-spacing: 0.5px;">Mulai Tugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataKader as $kader)
                        <tr class="table-row-hover">
                            <td class="px-4 py-4">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3 avatar-bounce"
                                        style="width: 45px; height: 45px; background: linear-gradient(135deg, #7a9b85 0%, #8dad98 100%); color: white; font-weight: bold; box-shadow: 0 4px 12px rgba(122,155,133,0.4); font-size: 1.1rem;">
                                        {{ substr($kader->warga->nama ?? 'N', 0, 1) }}
                                    </div>
                                    <strong style="color: #1a4d4d; font-size: 1rem; font-weight: 700;">{{ $kader->warga->nama ?? '-' }}</strong>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <span style="color: #2d2d2d; font-weight: 600; font-size: 0.95rem;">{{ $kader->posyandu->nama ?? '-' }}</span>
                            </td>
                            <td class="px-4 py-4">
                                <span class="badge rounded-pill px-4 py-2 text-white fw-bold" style="background: linear-gradient(135deg, #d4b896 0%, #e0c9a9 100%); font-size: 0.9rem; letter-spacing: 0.3px; box-shadow: 0 4px 8px rgba(212,184,150,0.3);">
                                    <i class="bi bi-award me-1"></i>{{ $kader->peran }}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                <span style="color: #5a5a5a; font-weight: 500; font-size: 0.9rem;">
                                    <i class="bi bi-calendar-check me-1" style="color: #4a6b5c;"></i>{{ $kader->mulai_tugas }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 d-block mb-3" style="color: #7a9b85;"></i>
                                <p class="mb-0 fw-semibold" style="color: #4a6b5c; font-size: 1rem;">Belum ada data kader</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- 🧾 Layanan Posyandu Terbaru --}}
    <div class="card border-0 shadow-lg mb-5 card-animate" style="animation-delay: 0.8s; background: #ffffff; border-radius: 12px;">
        <div class="card-header border-0 py-4" style="background: linear-gradient(90deg, #7a9b85 0%, #8dad98 100%); border-radius: 12px 12px 0 0;">
            <div class="d-flex align-items-center">
                <div class="bg-white bg-opacity-25 rounded-3 p-2 me-3">
                    <i class="bi bi-clipboard2-pulse fs-4 text-white"></i>
                </div>
                <h5 class="mb-0 text-white fw-bold" style="font-size: 1.1rem; letter-spacing: 0.5px;">Layanan Posyandu Terbaru</h5>
            </div>
        </div>
        <div class="card-body p-0" style="background: #ffffff;">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr style="background: linear-gradient(90deg, #7a9b85 0%, #8dad98 100%);">
                            <th class="border-0 py-4 px-4 text-white fw-bold" style="font-size: 1rem; letter-spacing: 0.5px;">Nama Warga</th>
                            <th class="border-0 py-4 px-4 text-white fw-bold" style="font-size: 1rem; letter-spacing: 0.5px;">Tanggal Jadwal</th>
                            <th class="border-0 py-4 px-4 text-white fw-bold" style="font-size: 1rem; letter-spacing: 0.5px;">Berat (kg)</th>
                            <th class="border-0 py-4 px-4 text-white fw-bold" style="font-size: 1rem; letter-spacing: 0.5px;">Tinggi (cm)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataLayanan as $layanan)
                        <tr class="table-row-hover">
                            <td class="px-4 py-4">
                                <strong style="color: #1a4d4d; font-size: 1rem; font-weight: 700;">{{ $layanan->warga->nama ?? '-' }}</strong>
                            </td>
                            <td class="px-4 py-4">
                                @if(optional($layanan->jadwal)->tanggal)
                                <span style="color: #2d2d2d; font-weight: 600; font-size: 0.95rem;">
                                    <i class="bi bi-calendar-check me-1" style="color: #4a6b5c;"></i>
                                    {{ optional($layanan->jadwal)->tanggal }}
                                </span>
                                @else
                                <span style="color: #999999; font-weight: 500;">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-4">
                                @if($layanan->berat)
                                <span class="badge rounded-pill px-4 py-2 text-white fw-bold" style="background: linear-gradient(135deg, #4a6b5c 0%, #5d7f6f 100%); font-size: 0.9rem; letter-spacing: 0.3px; box-shadow: 0 4px 8px rgba(74,107,92,0.3);">
                                    <i class="bi bi-activity me-1"></i>{{ $layanan->berat }} kg
                                </span>
                                @else
                                <span style="color: #999999; font-weight: 500;">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-4">
                                @if($layanan->tinggi)
                                <span class="badge rounded-pill px-4 py-2 text-white fw-bold" style="background: linear-gradient(135deg, #d4b896 0%, #e0c9a9 100%); font-size: 0.9rem; letter-spacing: 0.3px; box-shadow: 0 4px 8px rgba(212,184,150,0.3);">
                                    <i class="bi bi-arrows-vertical me-1"></i>{{ $layanan->tinggi }} cm
                                </span>
                                @else
                                <span style="color: #999999; font-weight: 500;">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 d-block mb-3" style="color: #7a9b85;"></i>
                                <p class="mb-0 fw-semibold" style="color: #4a6b5c; font-size: 1rem;">Belum ada data layanan</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- Chart.js Library --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

{{-- Kirim data ke JavaScript menggunakan data attributes --}}
<script>
    // Set data ke canvas elements
    document.addEventListener('DOMContentLoaded', function() {
        const layananCanvas = document.getElementById('layananChart');
        if (layananCanvas) {
            layananCanvas.setAttribute('data-total', '{{ $totalLayanan ?? 0 }}');
        }

        const distribusiCanvas = document.getElementById('distribusiChart');
        if (distribusiCanvas) {
            distribusiCanvas.setAttribute('data-posyandu', '{{ $totalPosyandu ?? 0 }}');
            distribusiCanvas.setAttribute('data-kader', '{{ $totalKader ?? 0 }}');
            distribusiCanvas.setAttribute('data-jadwal', '{{ $totalJadwal ?? 0 }}');
            distribusiCanvas.setAttribute('data-layanan', '{{ $totalLayanan ?? 0 }}');
        }
    });
</script>

{{-- Load Chart Script --}}
<script src="{{ asset('js/dashboard-chart.js') }}"></script>


@endsection
