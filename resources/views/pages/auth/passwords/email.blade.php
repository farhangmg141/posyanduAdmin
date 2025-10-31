<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
@include('admin.layout.css')

   

</head>
<body>
    <div class="container">
        <h1>Lupa Password?</h1>
        <p>Masukkan alamat email Anda. Kami akan mengirimkan link untuk mereset password Anda.</p>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->has('email'))
            <div class="alert alert-danger">
                {{ $errors->first('email') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Alamat Email Anda">
            <button type="submit">Kirim Link Reset</button>
        </form>

        <a href="{{ route('login.show') }}">Kembali ke Login</a>
    </div>
</body>
</html>