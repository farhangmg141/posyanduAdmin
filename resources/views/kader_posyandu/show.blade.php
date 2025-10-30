@extends('admin.layout.master')
@section('title', 'Detail Kader Posyandu')

@section('content')


<div class="container mt-5">
    <h3>📋 Detail Kader Posyandu</h3>
    <ul class="list-group">
        <li class="list-group-item">
            <strong>Nama Warga:</strong>
            <span>{{ $kader_posyandu->warga->nama ?? '-' }}</span>
        </li>
        <li class="list-group-item">
            <strong>Posyandu:</strong>
            <span>{{ $kader_posyandu->posyandu->nama ?? '-' }}</span>
        </li>
        <li class="list-group-item">
            <strong>Peran:</strong>
            <span>{{ $kader_posyandu->peran }}</span>
        </li>
        <li class="list-group-item">
            <strong>Mulai Tugas:</strong>
            <span>{{ $kader_posyandu->mulai_tugas }}</span>
        </li>
        <li class="list-group-item">
            <strong>Akhir Tugas:</strong>
            <span>{{ $kader_posyandu->akhir_tugas ?? '-' }}</span>
        </li>
    </ul>
    <div class="text-center">
        <a href="{{ route('kader.index') }}" class="btn btn-secondary mt-4">← Kembali</a>
    </div>
</div>
@endsection
