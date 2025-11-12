@extends('layout.admin.master')

@section('title', 'Profil Admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Profil Admin</h4>
            <a href="{{ route('profilAdmin.edit') }}" class="btn btn-light btn-sm">
                <i class="bi bi-pencil-square"></i> Edit Profil
            </a>
        </div>

        <div class="card-body p-4">
            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                    <img src="{{ $profil && $profil->foto ? asset('uploads/profil/' . $profil->foto) : asset('images/default-avatar.png') }}"
                         alt="Foto Profil"
                         class="rounded-circle img-fluid mb-3 shadow-sm"
                         width="150" height="150">
                </div>
                <div class="col-md-9">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th style="width: 180px;">Nama</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>No. HP</th>
                            <td>{{ $profil->no_hp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $profil->alamat ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
