@extends('layout.admin.master')
@section('title', 'Dokumentasi')

@section('content')

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
/* === CONTAINER GALLERY === */
.gallery-wrapper {
    display: flex;
    overflow-x: auto;
    gap: 10px;
    padding: 10px;
    scroll-snap-type: x mandatory;
    scrollbar-width: none;
}
.gallery-wrapper::-webkit-scrollbar {
    display: none;
}

/* === IMAGE STYLE === */
.gallery-wrapper img {
    width: 240px !important;
    height: 170px !important;
    object-fit: cover;
    border-radius: 10px;
    scroll-snap-align: start;
    transition: .25s;
    box-shadow: 0 4px 10px rgba(0,0,0,.25);
}
.gallery-wrapper img:hover {
    transform: scale(1.05);
}

/* === FILE CARD FIXED DIMENSION === */
.file-box {
    width: 240px !important;
    height: 170px !important;
    border-radius: 10px;
    display: flex !important;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 6px;
    text-decoration: none !important;
    font-weight: 600;
    color: #fff !important;
    scroll-snap-align: start;
    transition: .25s;
    box-shadow: 0 4px 10px rgba(0,0,0,.25);
    position: relative;
}

/* Hover Effect */
.file-box:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 20px rgba(0,0,0,.35);
}

/* Icon */
.file-box i {
    font-size: 42px !important;
}

/* Badge pojok kiri */
.file-badge {
    position: absolute;
    top: 6px;
    left: 6px;
    background: rgba(0,0,0,.45);
    padding: 2px 8px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 700;
}

/* Warna berdasarkan jenis file */
.file-pdf { background: #e74c3c !important; }
.file-doc { background: #007bff !important; }
.file-xls { background: #27ae60 !important; }
.file-other { background: #7f8c8d !important; }

</style>

<div class="container mt-3">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="page-title text-white">Dokumentasi</h1>
        <a href="{{ route('admin.dokumentasi.create') }}" class="btn btn-success shadow">
            <i class="fas fa-plus me-1"></i> Tambah Dokumentasi
        </a>
    </div>

    <div class="row">
        @forelse($data as $item)
        <div class="col-md-4 mb-4">
            <div class="card shadow p-3 h-100">

                <div class="gallery-wrapper">
                    @foreach($item->fotos as $foto)

                        @php
                            $ext = strtolower(pathinfo($foto->file_name, PATHINFO_EXTENSION));
                            $isImage = in_array($ext, ['jpg','jpeg','png','gif']);
                        @endphp

                        @if($isImage)
                            <a href="/uploads/dokumentasi/{{ $foto->file_name }}" target="_blank">
                                <img src="/uploads/dokumentasi/{{ $foto->file_name }}">
                            </a>
                        @else
                            <a target="_blank" 
                               href="/uploads/dokumentasi/{{ $foto->file_name }}"
                               class="file-box 
                               { $ext=='pdf'?'file-pdf':(in_array($ext,['doc','docx'])?'file-doc':(in_array($ext,['xls','xlsx'])?'file-xls':'file-other'))) }   ">

                                <span class="file-badge">{{ strtoupper($ext) }}</span>
                                <i class="fas fa-file"></i>
                            </a>
                        @endif

                    @endforeach
                </div>

                <div class="card-body text-center">
                    <h5 class="card-title text-white fw-bold">{{ $item->judul }}</h5>

                    <div class="d-flex justify-content-center gap-2 mt-2">
                        <a href="{{ route('admin.dokumentasi.show', $item->id) }}" class="btn btn-outline-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.dokumentasi.edit', $item->id) }}" class="btn btn-outline-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-outline-danger btn-sm delete-btn"
                            data-id="{{ $item->id }}" data-title="{{ $item->judul }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>

                </div>

            </div>
        </div>
        @empty
        <div class="text-center text-white p-5">
            <i class="fas fa-images fa-4x mb-3"></i>
            <h5>Belum ada dokumentasi</h5>
        </div>
        @endforelse
    </div>

    {{ $data->links() }}

</div>
@include('layout.admin.footer')


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
@if(session('success'))
Swal.fire({
    title: 'Berhasil!',
    text: '{{ session("success") }}',
    icon: 'success',
    showConfirmButton: false,
    timer: 2000
});
@endif

document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function(){
        let id = this.dataset.id;
        let title = this.dataset.title;

        Swal.fire({
            title: 'Hapus?',
            html: "Data dokumentasi <b>" + title + "</b> akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = `/dokumentasi/${id}`;
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(form);
                form.submit();
            }
        })
    });
});
</script>

@endsection
