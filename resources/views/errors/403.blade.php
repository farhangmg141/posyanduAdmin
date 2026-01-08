@extends('layout.admin.master')

@section('title', '403 | Akses Ditolak')

@section('content')

<style>
    html, body {
        margin: 0;
        padding: 0;
        background: linear-gradient(135deg, #0f1f1b, #162824);
        overflow-x: hidden;
    }

    .error-wrapper {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .error-card {
        background: linear-gradient(180deg, #1e342e, #172722);
        border-radius: 22px;
        max-width: 520px;
        width: 100%;
        padding: 40px 32px;
        text-align: center;
        box-shadow: 0 25px 60px rgba(0,0,0,.45);
        animation: fadeUp .8s ease;
        color: #eaf5f1;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .error-icon {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        box-shadow: inset 0 0 20px rgba(255,255,255,.08);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(125,165,140,.6); }
        70% { box-shadow: 0 0 0 18px rgba(125,165,140,0); }
        100% { box-shadow: 0 0 0 0 rgba(125,165,140,0); }
    }

    .error-code {
        font-size: 96px;
        font-weight: 800;
        letter-spacing: 6px;
        color: #ffb4a2;
        margin-bottom: 10px;
    }

    .error-title {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .error-desc {
        font-size: 14px;
        color: #cfe5dc;
        line-height: 1.7;
        margin-bottom: 30px;
    }

    .error-desc span {
        background: #7da58c;
        color: #0f1f1b;
        padding: 3px 10px;
        border-radius: 12px;
        font-weight: 700;
    }

    .error-actions {
        display: flex;
        gap: 12px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-dashboard {
        background: #7da58c;
        color: #0f1f1b;
        font-weight: 700;
        border-radius: 10px;
        padding: 10px 18px;
        border: none;
    }

    .btn-back {
        background: transparent;
        border: 1px solid #7da58c;
        color: #7da58c;
        font-weight: 600;
        border-radius: 10px;
        padding: 10px 18px;
    }

    .btn-dashboard:hover {
        background: #9cc3ad;
    }

    .btn-back:hover {
        background: rgba(125,165,140,.1);
    }

    .footer-note {
        margin-top: 28px;
        font-size: 12px;
        color: #9fbdb1;
    }

    @media (max-width: 576px) {
        .error-card {
            padding: 32px 22px;
        }

        .error-code {
            font-size: 72px;
        }
    }
</style>

<div class="error-wrapper">

    <div class="error-card">

        {{-- ICON --}}
        <div class="error-icon">
            <i class="bi bi-shield-lock-fill fs-1 text-success"></i>
        </div>

        {{-- CODE --}}
        <div class="error-code">403</div>

        {{-- TITLE --}}
        <div class="error-title">
            Akses Ditolak
        </div>

        {{-- DESCRIPTION --}}
        <div class="error-desc">
            Maaf, halaman ini hanya dapat diakses oleh
            <br>
            <span>Administrator Posyandu</span>.
            <br>
            Silakan kembali ke halaman yang sesuai.
        </div>

        {{-- ACTION --}}
        <div class="error-actions">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-dashboard">
                <i class="bi bi-house-door-fill me-1"></i> Dashboard
            </a>

            <button onclick="history.back()" class="btn btn-back">
                <i class="bi bi-arrow-left"></i> Kembali
            </button>
        </div>

        {{-- FOOTER --}}
        <div class="footer-note">
            Sistem Informasi Posyandu • Keamanan Akses Aktif
        </div>

    </div>

</div>

<script>
    // Efek kecil saat load
    document.addEventListener('DOMContentLoaded', () => {
        const card = document.querySelector('.error-card');
        card.style.transform = 'scale(.96)';
        setTimeout(() => {
            card.style.transition = '.4s ease';
            card.style.transform = 'scale(1)';
        }, 120);
    });
</script>

@endsection
