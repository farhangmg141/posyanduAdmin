    <!-- 🔹 MOBILE SIDEBAR TOGGLE BUTTON -->
    <button id="mobileSidebarToggle" class="mobile-toggle d-lg-none">
        ☰
    </button>

    <style>
    .mobile-toggle {
        position: fixed;
        top: 15px;
        left: 15px;
        z-index: 2002;
        background: #ffffff;
        color: #fff;
        border: none;
        padding: 10px 14px;
        border-radius: 8px;
        font-size: 20px;
        box-shadow: 0 0 5px rgba(0,0,0,0.4);
    }
    </style>


    <!-- 🔹 SIDEBAR FIXED (DEKSTOP & MOBILE) -->
    <nav id="sidebarMenu" class="sidebar text-white" data-simplebar>
        <div class="sidebar-inner px-4 pt-3">
            <ul class="nav flex-column pt-3 pt-md-0">

                <!-- LOGO -->
                <li class="nav-item text-center mb-3">
                    <a href="#" class="nav-link d-flex flex-column align-items-center">
                        <img src="https://1.bp.blogspot.com/-vNcUzj8YRPo/YNaCWN7kmLI/AAAAAAAAFaE/Q0YIFTjsM-kDUxl8VXWNHN86WZtELt8MwCLcBGAsYHQ/s1600/Logo%2BPosyandu.png"
                            height="90" width="90" class="mb-2">
                        <span class="sidebar-text fs-5 fw-bold text-uppercase">Posyandu</span>
                    </a>
                </li>

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                            </svg>
                        </span>
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </li>

                <!-- Data Posyandu -->
                <li class="nav-item">
                    <a href="{{ url('data/dataPosyandu') }}" class="nav-link {{ request()->is('data/dataPosyandu*') ? 'active' : '' }}">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 4h18v2H3V4zm0 6h18v2H3v-2zm0 6h18v2H3v-2z"></path>
                            </svg>
                        </span>
                        <span class="sidebar-text">Data Posyandu</span>
                    </a>
                </li>

                <!-- Kader Posyandu -->
                <li class="nav-item">
                    <a href="{{ url('kader-posyandu') }}" class="nav-link {{ request()->is('kader-posyandu*') ? 'active' : '' }}">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-3.31 0-6 1.34-6 3v3h12v-3c0-1.66-2.69-3-6-3z"></path>
                            </svg>
                        </span>
                        <span class="sidebar-text">Kader Posyandu</span>
                    </a>
                </li>

                <!-- Warga -->
                <li class="nav-item">
                    <a href="{{ url('warga') }}" class="nav-link {{ request()->is('warga*') ? 'active' : '' }}">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-3.31 0-6 1.34-6 3v3h12v-3c0-1.66-2.69-3-6-3z"></path>
                            </svg>
                        </span>
                        <span class="sidebar-text">Warga</span>
                    </a>
                </li>

                <!-- User Admin -->
                <li class="nav-item">
                    <a href="{{ url('admin/useradmin') }}" class="nav-link {{ request()->is('admin/useradmin*') ? 'active' : '' }}">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-3.31 0-6 1.34-6 3v3h12v-3c0-1.66-2.69-3-6-3z"/>
                            </svg>
                        </span>
                        <span class="sidebar-text">User Admin</span>
                    </a>
                </li>

                <!-- Jadwal -->
                <li class="nav-item">
                    <a href="{{ url('jadwal-posyandu') }}" class="nav-link {{ request()->is('jadwal-posyandu*') ? 'active' : '' }}">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 7V3h8v4h5v2H3V7h5zm-2 4h12v9H6v-9z"></path>
                            </svg>
                        </span>
                        <span class="sidebar-text">Jadwal Posyandu</span>
                    </a>
                </li>

                <!-- Layanan -->
<a href="{{ route('layanan.index') }}"
    class="nav-link {{ request()->routeIs('layanan.*') ? 'active' : '' }}">
    <span class="sidebar-icon">
        <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 24 24">
            <path d="M4 4h16v2H4V4zm0 4h16v2H4V8zm0 4h10v2H4v-2zm0 4h10v2H4v-2z"></path>
        </svg>
    </span>
    <span class="sidebar-text">Layanan Posyandu</span>
</a>

                <!-- Imunisasi -->
                <li class="nav-item">
                    <a href="{{ url('admin/imunisasi') }}" class="nav-link {{ request()->is('admin/imunisasi*') ? 'active' : '' }}">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17 2H7C5.9 2 5 2.9 5 4v16l7-3 7 3V4c0-1.1-.9-2-2-2z"></path>
                            </svg>
                        </span>
                        <span class="sidebar-text">Catatan Imunisasi</span>
                    </a>
                </li>

                <!-- Dokumentasi -->
                <li class="nav-item mt-4">
                    <a href="{{ url('admin/dokumentasi') }}" class="nav-link {{ request()->is('admin/dokumentasi*') ? 'active' : '' }}">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                            </svg>
                        </span>
                        <span class="sidebar-text">Dokumentasi</span>
                    </a>
                </li>

                <!-- Profil -->
                <li class="nav-item mt-3">
                    <a href="{{ route('profilAdmin.index') }}" class="nav-link {{ request()->is('admin/profil*') ? 'active' : '' }}">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/>
                            </svg>
                        </span>
                        <span class="sidebar-text">Profil Admin</span>
                    </a>
                </li>

                <!-- LOGOUT -->
                <li class="nav-item logout-slide mt-auto">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                            <span class="sidebar-icon">
                                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                                        clip-rule="evenodd">
                                    </path>
                                </svg>
                            </span>
                            <span class="sidebar-text">Logout</span>
                        </a>
                    </form>
                </li>

            </ul>
        </div>
    </nav>


    <!-- 🔹 SIDEBAR RESPONSIVE CSS -->
    <style>
    /* DESKTOP (tetap) */
    .sidebar {
        width: 270px;
        background: #102d2c;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 2001;
        transition: all 0.3s ease;
    }

    /* MOBILE DEFAULT: HIDDEN */
    @media (max-width: 991px) {
        .sidebar {
            left: -280px;
        }

        .sidebar.active {
            left: 0;
        }
    }
    </style>


    <!-- 🔹 MOBILE SIDEBAR TOGGLE SCRIPT -->
    <script>
    document.getElementById('mobileSidebarToggle').addEventListener('click', function () {
        document.getElementById('sidebarMenu').classList.toggle('active');
    });
    </script>
