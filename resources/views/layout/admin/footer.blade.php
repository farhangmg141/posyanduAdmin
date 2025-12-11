
<footer class="bg-light text-center py-4 border-top mt-5">
    <div class="container">

        <!-- Link ke Identitas Pengembang -->
        <p class="fw-bold mb-1">
            <a href="{{ route('identitas.pengembang') }}" class="text-decoration-none">
                <i class="bi bi-person-badge-fill"></i> Identitas Pengembang
            </a>
        </p>

        <!-- Nama Pengembang -->
        <p class="mb-1">
            Fathur Rahman • NIM 2457301053 • Sistem Informasi
        </p>

        <!-- Sosial Media -->
        <div class="mt-2 mb-3">
            <a href="https://linkedin.com" target="_blank" class="text-decoration-none mx-2">
                <i class="bi bi-linkedin"></i>
            </a>

            <a href="https://github.com" target="_blank" class="text-decoration-none mx-2">
                <i class="bi bi-github"></i>
            </a>

            <a href="https://instagram.com" target="_blank" class="text-decoration-none mx-2">
                <i class="bi bi-instagram"></i>

            </a>
        </div>

        <!-- Copyright -->
        <small class="text-muted">© {{ date('Y') }} Sistem Informasi Posyandu</small>
    </div>
</footer>
