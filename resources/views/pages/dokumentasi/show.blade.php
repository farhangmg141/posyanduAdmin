@extends('layout.admin.master')
@section('title', 'Detail Dokumentasi')

@section('content')

<style>
    .img-thumb {
        cursor: pointer;
        transition: .2s;
    }
    .img-thumb:hover {
        transform: scale(1.03);
        box-shadow: 0 4px 8px rgba(0,0,0,.25);
    }
</style>

<div class="container mt-4">

    <a href="{{ route('admin.dokumentasi.index') }}" class="btn btn-secondary mb-3">
        ← Kembali
    </a>

    <h3 class="fw-bold">{{ $dokumentasi->judul }}</h3>
    <p class="text-muted">{{ $dokumentasi->deskripsi }}</p>

    <hr>

    <h5 class="fw-bold">Galeri Foto</h5>
    <div class="row mt-3">

        @foreach($dokumentasi->fotos as $foto)
            <div class="col-md-4 mb-3">
                <img src="{{ asset('storage/dokumentasi/' . $foto->foto) }}"
                     class="img-fluid rounded shadow img-thumb"
                     data-bs-toggle="modal"
                     data-bs-target="#imageModal"
                     data-img="{{ asset('storage/dokumentasi/' . $foto->foto) }}">
            </div>
        @endforeach

    </div>

</div>

{{-- Modal popup foto --}}
<div class="modal fade" id="imageModal" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Preview Foto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body text-center">
        <img id="modalImage" src="" class="img-fluid rounded shadow">
      </div>

      <div class="modal-footer">
        <a id="downloadBtn" href="" download class="btn btn-success">
            ⬇️ Download Foto
        </a>
        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>

    </div>
  </div>
</div>

<script>
    // Saat thumbnail diklik → tampilkan di modal
    document.querySelectorAll('.img-thumb').forEach(img => {
        img.addEventListener('click', function () {
            let src = this.dataset.img;
            document.getElementById('modalImage').src = src;
            document.getElementById('downloadBtn').href = src;
        });
    });
</script>

@endsection
