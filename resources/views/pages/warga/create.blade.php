@extends('layout.admin.master')

@section('title', 'Tambah Warga')

@section('content')
<div class="container mt-4" style="max-width: 700px;">

    <h3 class="mb-4 fw-bold" style="color: #D6BD98;">
        <i class="fas fa-user-plus me-2"></i> Tambah Data Warga
    </h3>

    {{-- ALERT ERROR VALIDASI --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow" style="background-color: #213830; border-radius: 12px;">
        <div class="card-body p-4">

            <form action="{{ route('warga.store') }}" method="POST">
                @csrf

                {{-- Nama --}}
                <div class="mb-3">
                    <label class="form-label" style="color: #D6BD98;">Nama Warga</label>
                    <input type="text" name="nama"
                           class="form-control"
                           style="background-color: #40534C; border-color:#677D6A; color:#D6BD98;"
                           placeholder="Masukkan nama lengkap..."
                           value="{{ old('nama') }}" required>
                </div>

                {{-- NIK --}}
                <div class="mb-3">
                    <label class="form-label" style="color: #D6BD98;">NIK</label>
                    <input type="text" name="nik"
                           class="form-control"
                           style="background-color: #40534C; border-color:#677D6A; color:#D6BD98;"
                           placeholder="Masukkan NIK..."
                           value="{{ old('nik') }}" required>
                </div>

                {{-- No HP --}}
                <div class="mb-3">
                    <label class="form-label" style="color: #D6BD98;">No HP</label>
                    <input type="text" name="no_hp"
                           class="form-control"
                           style="background-color: #40534C; border-color:#677D6A; color:#D6BD98;"
                           placeholder="Opsional"
                           value="{{ old('no_hp') }}">
                </div>

                {{-- Alamat --}}
                <div class="mb-3">
                    <label class="form-label" style="color: #D6BD98;">Alamat</label>
                    <textarea name="alamat" rows="3"
                              class="form-control"
                              style="background-color: #40534C; border-color:#677D6A; color:#D6BD98;"
                              placeholder="Masukkan alamat lengkap..."
                              required>{{ old('alamat') }}</textarea>
                </div>

                {{-- Jenis Kelamin --}}
                <div class="mb-3">
                    <label class="form-label" style="color: #D6BD98;">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select"
                            style="background-color: #40534C; border-color:#677D6A; color:#D6BD98;" required>
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                {{-- Tanggal Lahir --}}
                <div class="mb-3">
                    <label class="form-label" style="color: #D6BD98;">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir"
                           class="form-control"
                           style="background-color: #40534C; border-color:#677D6A; color:#D6BD98;"
                           value="{{ old('tanggal_lahir') }}">
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between mt-4">

                    <a href="{{ route('warga.index') }}"
                       class="btn px-4"
                       style="background-color: transparent; border-color:#677D6A; color:#D6BD98;">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>

                    <button class="btn px-4"
                            style="background-color: #677D6A; color:#D6BD98; border-radius: 6px;">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>
@endsection
