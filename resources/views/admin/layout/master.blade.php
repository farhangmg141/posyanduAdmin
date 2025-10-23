<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard Admin')</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assetsAdmin/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assetsAdmin/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assetsAdmin/img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assetsAdmin/img/favicon/site.webmanifest') }}">
    <meta name="theme-color" content="#0E2F32">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Volt CSS -->
    <link rel="stylesheet" href="{{ asset('assetsAdmin/css/volt.css') }}">

    <!-- Custom Theme -->
    <style>
        :root {
            --hijau-tua: #0E2F32;
            --hijau-medium: #40534C;
            --hijau-lembut: #5C7266;
            --hijau-muda: #718C74;
            --beige: #D9C3A3;
            --beige-light: #EAD9C0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #0a1f21;
            color: var(--beige);
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        /* ===== SCROLLBAR HIDDEN (GLOBAL) - KECUALI SIDEBAR ===== */
        body, main.content {
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE and Edge */
        }

        body::-webkit-scrollbar, 
        main.content::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */
        }

        /* ===== SIDEBAR MODERN ===== */
        .sidebar {
            background: rgba(26, 43, 46, 0.98) !important;
            border-right: 1px solid rgba(217, 195, 163, 0.08);
            position: fixed;
            height: 100vh;
            width: 260px;
            z-index: 1000;
            backdrop-filter: blur(20px);
            overflow-y: auto !important;
            overflow-x: hidden !important;
        }

        /* Scrollbar Sidebar - Visible dan Stylish */
        .sidebar {
            scrollbar-width: thin !important; /* Firefox - scrollbar tipis */
            scrollbar-color: rgba(217, 195, 163, 0.4) rgba(26, 43, 46, 0.3) !important;
        }

        .sidebar::-webkit-scrollbar {
            width: 8px !important;
            display: block !important;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(26, 43, 46, 0.3) !important;
            border-radius: 10px !important;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(217, 195, 163, 0.4) !important;
            border-radius: 10px !important;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(217, 195, 163, 0.6) !important;
        }

        .sidebar-inner {
            padding: 1.25rem 0.75rem !important;
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }

        /* Logo Compact */
        .sidebar .nav-item.text-center {
            margin-bottom: 1.5rem !important;
            padding: 0.75rem 0;
            position: relative;
        }

        .sidebar .nav-item.text-center::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 20%;
            right: 20%;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--beige), transparent);
            opacity: 0.3;
        }

        .sidebar .nav-item.text-center img {
            width: 65px;
            height: 65px;
            object-fit: contain;
            filter: brightness(1.1) drop-shadow(0 3px 8px rgba(0, 0, 0, 0.4));
        }

        /* Logo tidak bisa diklik */
        .sidebar .nav-item.text-center .nav-link {
            pointer-events: none;
            cursor: default;
        }

        .sidebar-text.fs-5 {
            color: var(--beige-light);
            font-weight: 600;
            letter-spacing: 2px;
            font-size: 0.95rem !important;
            margin-top: 0.5rem;
        }

        /* Navigation Modern Minimalist */
        .sidebar .nav-link {
            color: rgba(217, 195, 163, 0.75);
            padding: 0.7rem 1rem;
            margin: 0.2rem 0.5rem;
            border-radius: 8px;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            font-size: 0.875rem;
            font-weight: 450;
            border: 1px solid transparent;
            position: relative;
        }

        .sidebar .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 0;
            background: var(--beige);
            border-radius: 0 3px 3px 0;
            transition: height 0.25s ease;
        }

        .sidebar .nav-link:hover {
            background: rgba(217, 195, 163, 0.08);
            color: var(--beige-light);
            border-color: rgba(217, 195, 163, 0.15);
        }

        .sidebar .nav-link:hover::before {
            height: 60%;
        }

        .sidebar .nav-link.active {
            background: rgba(217, 195, 163, 0.12);
            color: var(--beige-light);
            border-color: rgba(217, 195, 163, 0.2);
            font-weight: 500;
        }

        .sidebar .nav-link.active::before {
            height: 70%;
        }

        .sidebar-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            margin-right: 0.65rem;
            flex-shrink: 0;
        }

        .sidebar-icon svg {
            color: var(--beige);
            width: 18px;
            height: 18px;
            opacity: 0.85;
        }

        .sidebar .nav-link:hover .sidebar-icon svg,
        .sidebar .nav-link.active .sidebar-icon svg {
            opacity: 1;
            color: var(--beige-light);
        }

        /* Logout Section */
        .sidebar form {
            margin-top: auto;
            padding-top: 1.5rem;
            position: relative;
        }

        .sidebar form::before {
            content: '';
            position: absolute;
            top: 0;
            left: 20%;
            right: 20%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(217, 195, 163, 0.2), transparent);
        }

        .sidebar form .nav-link {
            color: rgba(217, 195, 163, 0.65);
        }

        .sidebar form .nav-link:hover {
            background: rgba(255, 100, 100, 0.08);
            border-color: rgba(255, 100, 100, 0.2);
            color: #ffb3b3;
        }

        .sidebar form .nav-link:hover::before {
            background: #ff6b6b;
        }

        /* ===== NAVBAR (Mobile) ===== */
        .navbar {
            background: rgba(14, 47, 50, 0.95);
            border-bottom: 1px solid rgba(217, 195, 163, 0.15);
            backdrop-filter: blur(20px);
        }

        .navbar-brand img {
            filter: brightness(1.1);
        }

        .navbar-toggler {
            border: 1px solid rgba(217, 195, 163, 0.25);
            padding: 0.4rem 0.7rem;
            border-radius: 6px;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.15rem rgba(217, 195, 163, 0.2);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%23D9C3A3' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* ===== MAIN CONTENT MODERN ===== */
        main.content {
            background: #0a1f21;
            min-height: 100vh;
            padding: 1.75rem;
            margin-left: 260px;
            position: relative;
        }

        /* Subtle background pattern */
        main.content::before {
            content: '';
            position: fixed;
            top: 0;
            left: 260px;
            right: 0;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 30%, rgba(113, 140, 116, 0.04) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(64, 83, 76, 0.04) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        main.content > * {
            position: relative;
            z-index: 1;
        }

        /* ===== CARDS MINIMALIST ===== */
        .card {
            background: rgba(40, 60, 58, 0.6);
            border: 1px solid rgba(217, 195, 163, 0.1);
            color: var(--beige);
            border-radius: 12px;
            backdrop-filter: blur(10px);
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        }

        /* ===== BUTTONS MODERN ===== */
        .btn-primary {
            background: linear-gradient(135deg, #5a7360 0%, #4a6450 100%);
            border: none;
            color: var(--beige-light);
            font-weight: 500;
            padding: 0.6rem 1.4rem;
            border-radius: 8px;
            transition: all 0.25s ease;
            font-size: 0.9rem;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--beige) 0%, #c9b396 100%);
            color: var(--hijau-tua);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(217, 195, 163, 0.25);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 991.98px) {
            .sidebar {
                position: fixed;
                left: -260px;
                transition: left 0.3s ease;
            }

            .sidebar.show {
                left: 0;
            }

            main.content {
                margin-left: 0;
            }

            main.content::before {
                left: 0;
            }
        }

        @media (max-width: 768px) {
            main.content {
                padding: 1.25rem 0.75rem;
            }
        }

        /* ===== UTILITIES ===== */
        .text-beige {
            color: var(--beige) !important;
        }

        .text-beige-light {
            color: var(--beige-light) !important;
        }

        .bg-hijau-medium {
            background-color: var(--hijau-medium) !important;
        }

        .bg-hijau-lembut {
            background-color: var(--hijau-lembut) !important;
        }

        /* ===== SMOOTH ENTRANCE ===== */
        .sidebar .nav-item {
            opacity: 0;
            animation: fadeInLeft 0.4s ease forwards;
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .sidebar .nav-item:nth-child(1) { animation-delay: 0s; }
        .sidebar .nav-item:nth-child(2) { animation-delay: 0.05s; }
        .sidebar .nav-item:nth-child(3) { animation-delay: 0.1s; }
        .sidebar .nav-item:nth-child(4) { animation-delay: 0.15s; }
        .sidebar .nav-item:nth-child(5) { animation-delay: 0.2s; }
        .sidebar .nav-item:nth-child(6) { animation-delay: 0.25s; }
        .sidebar .nav-item:nth-child(7) { animation-delay: 0.3s; }
        .sidebar .nav-item:nth-child(8) { animation-delay: 0.35s; }

        /* ===== COMPACT SPACING ===== */
        .container-fluid {
            max-width: 100%;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        h1, h2, h3, h4, h5, h6 {
            margin-bottom: 1rem;
        }

        .mt-4 {
            margin-top: 1rem !important;
        }

        .mb-4 {
            margin-bottom: 1rem !important;
        }

        .mb-5 {
            margin-bottom: 1.5rem !important;
        }

        .py-4 {
            padding-top: 1.25rem !important;
            padding-bottom: 1.25rem !important;
        }

        .card-body {
            padding: 1.25rem !important;
        }

        /* Focus visible untuk accessibility */
        *:focus-visible {
            outline: 2px solid rgba(217, 195, 163, 0.5);
            outline-offset: 2px;
        }
        
    </style>

    @stack('styles')
</head>

<body>

    <!-- 🔹 Navbar (Mobile) -->
    <nav class="navbar navbar-dark px-4 col-12 d-lg-none">
        <a class="navbar-brand me-lg-5" href="#">
            <img class="navbar-brand-dark" src="{{ asset('assetsAdmin/img/brand/light.svg') }}" alt="Logo" />
        </a>
        <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <!-- 🔹 Sidebar -->
    <nav id="sidebarMenu" class="sidebar d-lg-block text-white collapse" data-simplebar>
        <div class="sidebar-inner px-4 pt-3">
            <ul class="nav flex-column pt-3 pt-md-0">
                <!-- Logo -->
                <li class="nav-item text-center mb-3">
                    <a href="#" class="nav-link d-flex flex-column align-items-center">
                        <img src="https://1.bp.blogspot.com/-vNcUzj8YRPo/YNaCWN7kmLI/AAAAAAAAFaE/Q0YIFTjsM-kDUxl8VXWNHN86WZtELt8MwCLcBGAsYHQ/s1600/Logo%2BPosyandu.png"
                            height="90" width="90" alt="Logo Posyandu" class="mb-2" style="object-fit: contain;">
                        <span class="sidebar-text fs-5 fw-bold text-uppercase">Posyandu</span>
                    </a>
                </li>

                <!-- Menu -->
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link {{ request()->is('/dashboard') ? 'active' : '' }}">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                            </svg>
                        </span>
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('data/dataPosyandu') }}" class="nav-link {{ request()->is('data/dataPosyandu') ? 'active' : '' }}">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 4h18v2H3V4zm0 6h18v2H3v-2zm0 6h18v2H3v-2z"></path>
                            </svg>
                        </span>
                        <span class="sidebar-text">Data Posyandu</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/kader') }}" class="nav-link {{ request()->is('admin/kader') ? 'active' : '' }}">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-3.31 0-6 1.34-6 3v3h12v-3c0-1.66-2.69-3-6-3z">
                                </path>
                            </svg>
                        </span>
                        <span class="sidebar-text">Kader Posyandu</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/jadwal') }}" class="nav-link {{ request()->is('admin/jadwal') ? 'active' : '' }}">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 7V3h8v4h5v2H3V7h5zm-2 4h12v9H6v-9z"></path>
                            </svg>
                        </span>
                        <span class="sidebar-text">Jadwal Posyandu</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/layanan') }}" class="nav-link {{ request()->is('admin/layanan') ? 'active' : '' }}">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4 4h16v2H4V4zm0 4h16v2H4V8zm0 4h10v2H4v-2zm0 4h10v2H4v-2z"></path>
                            </svg>
                        </span>
                        <span class="sidebar-text">Layanan Posyandu</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/imunisasi') }}" class="nav-link {{ request()->is('admin/imunisasi') ? 'active' : '' }}">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17 2H7C5.9 2 5 2.9 5 4v16l7-3 7 3V4c0-1.1-.9-2-2-2z"></path>
                            </svg>
                        </span>
                        <span class="sidebar-text">Catatan Imunisasi</span>
                    </a>
                </li>

                <li class="nav-item mt-4">
                    <a href="{{ url('admin/dokumentasi') }}" class="nav-link {{ request()->is('admin/dokumentasi') ? 'active' : '' }}">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                        <span class="sidebar-text">Dokumentasi</span>
                    </a>
                </li>

                <!-- logout -->
                  <li class="nav-item logout-slide mt-auto">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="nav-link"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <span class="sidebar-icon">
                                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                            <span class="sidebar-text">Logout</span>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </nav>


    <!-- 🔹 Main Content -->
    <main class="content">
        @yield('content')
    </main>

    @stack('scripts')
</body>

</html>