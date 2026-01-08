@extends('layout.admin.master')

@section('title', 'Profil Admin')

@section('content')
<style>
    .profile-wrapper {
        max-width: 950px;
        margin: auto;
        margin-top: 40px;
    }
    .profile-card {
        background: rgba(0, 0, 0, .18);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 22px rgba(0,0,0,.35);
        transition: .3s;
    }
    .profile-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 27px rgba(0,0,0,.45);
    }
    .profile-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: rgba(255,255,255,.07);
        padding: 18px 26px;
    }
    .profile-header h4 {
        margin: 0;
        color: #fff;
        font-weight: 600;
        letter-spacing: .5px;
    }
    .profile-body {
        padding: 35px;
    }
    .profile-photo-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 25px;
    }
    .profile-photo {
        width: 170px;
        height: 170px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid rgba(255,255,255,.35);
        box-shadow: 0 4px 12px rgba(0,0,0,.4);
        transition: .25s;
    }
    .profile-photo:hover {
        transform: scale(1.07);
    }
    .info-box {
        background: rgba(255,255,255,.06);
        padding: 25px 30px;
        border-radius: 14px;
    }
    th {
        color: #fff;
        width: 170px;
        font-weight: 600;
        padding: 10px 0;
    }
    td {
        color: #e8e8e8;
        padding: 10px 0;
    }
</style>

<div class="profile-wrapper">
    <div class="profile-card">

        {{-- Header --}}
        <div class="profile-header">
            <h4><i class="bi bi-person-circle me-2"></i> Profil Admin</h4>

            <a href="{{ route('profilAdmin.edit') }}" class="btn btn-light btn-sm fw-semibold">
                <i class="bi bi-pencil-square me-1"></i> Edit Profil
            </a>
        </div>

        {{-- Body --}}
        <div class="profile-body">

            {{-- Foto --}}
            <div class="profile-photo-container">
                <img src="{{ $profil && $profil->foto ? asset('uploads/profil/' . $profil->foto) : asset('images/default-avatar.png') }}"
                     class="profile-photo"
                     alt="Foto Profil">
            </div>

            {{-- Informasi --}}
            <div class="info-box">
                <table class="table table-borderless mb-0">
                    <tr>
                        <th><i class="bi bi-person-fill me-2"></i>Nama</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-envelope-fill me-2"></i>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-phone-fill me-2"></i>No. HP</th>
                        <td>{{ $profil->no_hp ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-geo-alt-fill me-2"></i>Alamat</th>
                        <td>{{ $profil->alamat ?? '-' }}</td>
                    </tr>
                </table>
            </div>

        </div>

    </div>
</div>
@endsection
