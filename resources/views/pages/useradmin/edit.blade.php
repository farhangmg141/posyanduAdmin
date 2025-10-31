@extends('layout.admin.master')

@section('title', 'Edit User')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
        <h1 class="fw-bold text-primary mb-0">
            <i class="bi bi-person-gear me-2"></i> Edit User
        </h1>
        <a href="{{ route('useradmin.index') }}" class="btn btn-secondary shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <!-- SweetAlert Notifications -->
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan!',
                    html: '{!! implode("<br>", $errors->all()) !!}',
                });
            });
        </script>
    @endif

    <!-- Form Card -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4">
            <form action="{{ route('useradmin.update', $useradmin->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control shadow-sm"
                           value="{{ old('name', $useradmin->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control shadow-sm"
                           value="{{ old('email', $useradmin->email) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Role</label>
                    <select name="role" class="form-select shadow-sm" required>
                        <option value="admin" {{ $useradmin->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="staff" {{ $useradmin->role == 'staff' ? 'selected' : '' }}>Staff</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Password (opsional)</label>
                    <input type="password" name="password" class="form-control shadow-sm"
                           placeholder="Kosongkan jika tidak ingin mengubah password">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">
                        <i class="bi bi-save me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
