<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gemini AI Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">🤖 Generator Teks Gemini AI</h4>
                </div>
                <div class="card-body">
                    
                    <form action="{{ route('gemini.generate') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="prompt" class="form-label fw-bold">Masukkan Perintah (Prompt) Anda:</label>
                            <textarea 
                                class="form-control" 
                                id="prompt" 
                                name="prompt" 
                                rows="3" 
                                placeholder="Contoh: Tuliskan sebuah paragraf singkat tentang integrasi Gemini dan Laravel..." 
                                required>{{ old('prompt', $prompt ?? '') }}</textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-magic me-2"></i> Hasilkan Teks
                            </button>
                        </div>
                    </form>
                    
                    @isset($response)
                        <hr class="my-4">
                        <div class="alert alert-success mt-4">
                            <h5 class="alert-heading">✨ Hasil Generasi Gemini:</h5>
                            <pre style="white-space: pre-wrap; word-wrap: break-word; background-color: #e9ecef; padding: 15px; border-radius: 5px; border: 1px solid #dee2e6;">{{ $response }}</pre>
                        </div>
                    @endisset

                    @if(session('error'))
                        <hr class="my-4">
                        <div class="alert alert-danger mt-4">
                            <h5 class="alert-heading">⚠️ Terjadi Kesalahan:</h5>
                            <p>{{ session('error') }}</p>
                            <p class="mb-0">Pastikan **GEMINI\_API\_KEY** sudah dikonfigurasi dengan benar.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>