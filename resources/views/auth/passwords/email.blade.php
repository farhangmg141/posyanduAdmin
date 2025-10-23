<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #183A3A, #3B4D48); display: flex; justify-content: center; align-items: center; height: 100vh; font-family: 'Poppins', sans-serif; margin: 0; color: #D9C3A6; }
        .container { background: #3B4D48; padding: 40px 50px; border-radius: 15px; box-shadow: 0 14px 28px rgba(0,0,0,0.4); width: 100%; max-width: 450px; text-align: center; }
        h1 { font-weight: bold; margin-bottom: 10px; }
        p { font-size: 14px; color: #CBB999; margin-bottom: 25px; line-height: 1.5; }
        input { background-color: #667C68; border: none; color: #FFFDF8; padding: 12px 15px; margin: 8px 0; width: 100%; border-radius: 10px; outline: none; box-sizing: border-box; }
        button { border-radius: 20px; border: 1px solid #D9C3A6; background-color: #D9C3A6; color: #183A3A; font-size: 12px; font-weight: bold; padding: 12px 45px; letter-spacing: 1px; text-transform: uppercase; cursor: pointer; margin-top: 15px; }
        .alert { padding: 12px; border-radius: 8px; margin-bottom: 15px; font-size: 13px; text-align: left; }
        .alert-success { background: #2E4B34; color: #D9C3A6; }
        .alert-danger { background: #4B2E2E; color: #FFD2C1; }
        a { color: #D9C3A6; font-size: 13px; text-decoration: none; margin-top: 20px; display: inline-block; }
    </style>
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