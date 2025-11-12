@extends('layout.admin.master')

@section('title', 'Edit Profil Admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Profil</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('profilAdmin.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3 text-center">
                    <img src="{{ optional($profil)->foto_url ?? asset('images/default-avatar.png') }}"
                         id="preview-foto"
                         class="rounded-circle img-fluid mb-2 shadow-sm"
                         width="150" height="150">
                    <div>
                        <input type="file" name="foto" accept="image/*" class="form-control mt-2" onchange="previewImage(event)">
                        <small class="text-muted">Format: jpg, jpeg, png (max 2MB)</small>
                    </div>
                </div>

                <div class="mb-3">
    <label class="form-label">Nama (tidak bisa diubah)</label>
    <input type="text" class="form-control" value="{{ $user->name }}" disabled>
</div>

<div class="mb-3">
    <label class="form-label">Email (tidak bisa diubah)</label>
    <input type="email" class="form-control" value="{{ $user->email }}" disabled>
</div>


                <div class="mb-3">
                    <label class="form-label">No. HP</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $profil->no_hp) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3">{{ old('alamat', $profil->alamat) }}</textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('profilAdmin.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('preview-foto').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
