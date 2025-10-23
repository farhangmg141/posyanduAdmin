<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #183A3A, #3B4D48); display: flex; justify-content: center; align-items: center; height: 100vh; font-family: 'Poppins', sans-serif; margin: 0; color: #D9C3A6; }
        .container { background: #3B4D48; padding: 40px 50px; border-radius: 15px; box-shadow: 0 14px 28px rgba(0,0,0,0.4); width: 100%; max-width: 450px; text-align: center; }
        h1 { font-weight: bold; margin-bottom: 25px; }
        input { background-color: #667C68; border: none; color: #FFFDF8; padding: 12px 15px; margin: 8px 0; width: 100%; border-radius: 10px; outline: none; box-sizing: border-box; }
        button { border-radius: 20px; border: 1px solid #D9C3A6; background-color: #D9C3A6; color: #183A3A; font-size: 12px; font-weight: bold; padding: 12px 45px; letter-spacing: 1px; text-transform: uppercase; cursor: pointer; margin-top: 15px; }
        .alert-danger { padding: 12px; border-radius: 8px; margin-bottom: 15px; font-size: 13px; text-align: left; background: #4B2E2E; color: #FFD2C1; list-style-type: none; }
        .alert-danger ul { padding-left: 5px; margin: 0; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Buat Password Baru</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

            <input type="password" name="password" required autocomplete="new-password" placeholder="Password Baru">
            <input type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password Baru">
            
            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>
</html>