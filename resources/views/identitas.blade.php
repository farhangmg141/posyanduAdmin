@extends('layout.admin.master')

@section('content')

<!-- Style tambahan (khusus halaman ini) -->
<style>
    .icon-link {
        font-size: 2rem;
        transition: 0.25s ease-in-out;
    }
    .icon-link:hover {
        transform: scale(1.25);
        opacity: 0.85;
    }
</style>

<div class="container py-5">

    <div class="card border-0 shadow-lg mx-auto" style="max-width: 600px; border-radius: 20px;">
        <div class="card-body text-center py-5">

            <!-- Foto Asli -->
            <img src="{{ asset('assets/img/fathur.jpg') }}"
                 class="rounded-circle shadow mb-4"
                 width="160" height="160"
                 style="object-fit: cover; border: 4px solid #f8f9fa;">

            <!-- Nama & Info -->
            <h2 class="fw-bold mb-1">Fathur Rahman</h2>
            <p class="text-muted fs-5">NIM: 2457301053 • Sistem Informasi</p>

            <!-- Sosial Media -->
            <div class="d-flex justify-content-center gap-4 my-4">

                <!-- LinkedIn -->
                <a href="https://www.linkedin.com/in/fathur-rahman-609893399/" 
                   target="_blank"
                   class="icon-link"
                   style="color: #0A66C2;">
                    <i class="bi bi-linkedin"></i>
                </a>

                <!-- Github -->
                <a href="https://github.com/farhangmg141"
                   target="_blank"
                   class="icon-link"
                   style="color: #000;">
                    <i class="bi bi-github"></i>
                </a>

                <!-- Instagram -->
                <a href="https://instagram.com"
                   target="_blank"
                   class="icon-link"
                   style="color: #E1306C;">
                    <i class="bi bi-instagram"></i>
                </a>
            </div>

            <!-- Deskripsi -->
            <p class="text-muted mt-3 px-4" style="line-height: 1.6;">
                Sistem Informasi Posyandu — Dibuat sebagai proyek akademik untuk memenuhi tugas
                pengembangan aplikasi berbasis web. Halaman ini memuat identitas lengkap pengembang,
                termasuk informasi pribadi dan tautan sosial media.
            </p>

        </div>
    </div>

</div>

@endsection
