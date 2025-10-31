<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login & Register </title>

    <!-- CSRF TOKEN -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #183A3A, #3B4D48);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            color: #D9C3A6;
        }

        h1 {
            font-weight: bold;
            margin: 0;
            color: #D9C3A6;
        }

        p {
            font-size: 14px;
            font-weight: 300;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
            color: #CBB999;
        }

        span.form-subtitle {
            font-size: 13px;
            color: #CBB999;
        }

        a {
            color: #D9C3A6;
            font-size: 13px;
            text-decoration: none;
            margin: 15px 0;
            display: inline-block;
            transition: 0.3s;
        }

        a:hover {
            color: #EAD9C0;
        }

        .container {
            background: #3B4D48;
            border-radius: 15px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.4),
                0 10px 10px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
            width: 850px;
            max-width: 100%;
            min-height: 520px;
            display: flex;
        }

        form {
            background: #3B4D48;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0 50px;
            height: 100%;
            justify-content: center;
            text-align: center;
        }

        input {
            background-color: #667C68;
            border: none;
            color: #FFFDF8;
            /* teks putih lembut agar kontras */
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
            border-radius: 10px;
            outline: none;
            transition: 0.3s;
            font-size: 14px;
        }

        /* Saat fokus */
        input:focus {
            background-color: #748C74;
            box-shadow: 0 0 0 2px #D9C3A6;
            color: #FFFFFF;
            /* lebih putih saat fokus */
        }

        /* Placeholder (tulisan di dalam sebelum diisi) */
        input::placeholder {
            color: rgba(255, 255, 255, 0.65);
            /* putih transparan */
            font-weight: 400;
            letter-spacing: 0.3px;
        }


        button {
            border-radius: 20px;
            border: 1px solid #D9C3A6;
            background-color: #D9C3A6;
            color: #183A3A;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in, background-color 0.3s;
            margin-top: 10px;
            cursor: pointer;
        }

        button:hover {
            background-color: #EAD9C0;
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .sign-up-container {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container.right-panel-active .sign-in-container {
            transform: translateX(100%);
        }

        .container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        @keyframes show {

            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .overlay {
            background: linear-gradient(135deg, #183A3A, #667C68);
            color: #D9C3A6;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-left {
            transform: translateX(-20%);
        }

        .container.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        .ghost {
            background-color: transparent;
            border-color: #D9C3A6;
            color: #D9C3A6;
        }

        .ghost:hover {
            background-color: rgba(217, 195, 166, 0.1);
        }

        .alert {
            background: #4B2E2E;
            color: #FFD2C1;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
            font-size: 13px;
            width: 100%;
        }

        .alert-success {
            background: #2E4B34;
            color: #D9C3A6;
        }

        .logo-container svg {
            width: 50px;
            height: 50px;
            fill: #D9C3A6;
            margin-bottom: 15px;
        }

        .mobile-toggle {
            display: none;
            font-size: 13px;
            margin-top: 10px;
            color: #CBB999;
        }

        @media (max-width: 768px) {
            .container {
                width: 100%;
                min-height: 700px;
                border-radius: 0;
                box-shadow: none;
            }

            .sign-in-container,
            .sign-up-container {
                width: 100%;
                position: relative;
            }

            .overlay-container {
                display: none;
            }

            .mobile-toggle {
                display: block;
            }
        }
    </style>

</head>

<body>

    <script>
        window.addEventListener("pageshow", (event) => {
            if (
                event.persisted ||
                (performance.getEntriesByType("navigation")[0] &&
                    performance.getEntriesByType("navigation")[0].type === "reload")
            ) {
                const loginForm = document.getElementById("loginForm");
                const registerForm = document.getElementById("registerForm");

                if (loginForm) loginForm.reset();
                if (registerForm) registerForm.reset();
            }
        });
    </script>

    <div class="container" id="container">
        <!-- REGISTER -->
        <div class="form-container sign-up-container">
            <form id="registerForm" novalidate autocomplete="off">
                <div class="logo-container">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5zm0 10c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" />
                    </svg>
                </div>

                <h1>Buat Akun</h1>
                <span class="form-subtitle">Daftarkan diri Anda untuk memulai</span>
                <div id="registerAlert"></div>

                <input
                    type="text"
                    name="name"
                    placeholder="Nama Lengkap"
                    autocomplete="new-name"
                    required>

                <input
                    type="email"
                    name="email"
                    placeholder="Alamat Email"
                    autocomplete="new-email"
                    required>

                <input
                    type="password"
                    name="password"
                    placeholder="Password (min. 8 karakter)"
                    autocomplete="new-password"
                    required
                    minlength="8">

                <button type="submit">Daftar Sekarang</button>

                <div class="mobile-toggle">
                    Sudah punya akun? <a href="#" id="mobileSignIn">Masuk di sini</a>
                </div>
            </form>
        </div>


        <!-- LOGIN -->
        <div class="form-container sign-in-container">
            <form id="loginForm" novalidate autocomplete="off">
                <div class="logo-container">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5zm0 10c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" />
                    </svg>
                </div>

                <h1>Selamat Datang</h1>
                <span class="form-subtitle">Admin Posyandu</span>
                <div id="loginAlert"></div>

                <!-- Email -->
                <input
                    type="email"
                    name="email"
                    placeholder="Alamat Email"
                    autocomplete="new-email"
                    inputmode="email"
                    required>

                <!-- Password -->
                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    autocomplete="new-password"
                    required>

                <a href="{{ route('password.request') }}">Lupa password?</a>
                <button type="submit">Masuk</button>

                <div class="mobile-toggle">
                    Belum punya akun? <a href="#" id="mobileSignUp">Daftar di sini</a>
                </div>
            </form>
        </div>


        <!-- OVERLAY -->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Selamat Datang Kembali</h1>
                    <p>Masuk dengan akun Anda untuk melanjutkan Ke Dashboard Admin Posyandu</p>
                    <button class="ghost" id="signIn">Masuk</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Halo, Kader Posyandu</h1>
                    <p>daftar Dan Masuk ke Admin Posyandu</p>
                    <button class="ghost" id="signUp">Daftar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const container = document.getElementById('container');
        const signUpBtn = document.getElementById('signUp');
        const signInBtn = document.getElementById('signIn');
        const mobileSignUp = document.getElementById('mobileSignUp');
        const mobileSignIn = document.getElementById('mobileSignIn');

        if (signUpBtn && signInBtn) {
            signUpBtn.addEventListener('click', () => container.classList.add('right-panel-active'));
            signInBtn.addEventListener('click', () => container.classList.remove('right-panel-active'));
        }

        if (mobileSignUp && mobileSignIn) {
            mobileSignUp.addEventListener('click', (e) => {
                e.preventDefault();
                container.classList.add('right-panel-active');
            });

            mobileSignIn.addEventListener('click', (e) => {
                e.preventDefault();
                container.classList.remove('right-panel-active');
            });
        }


        async function handleForm(formId, routeUrl, alertId) {
            const form = document.getElementById(formId);
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.textContent;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            form.addEventListener('submit', async (e) => {
                e.preventDefault();

                const alertBox = document.getElementById(alertId);
                alertBox.innerHTML = '';
                submitBtn.disabled = true;
                submitBtn.textContent = 'Memproses...';

                const formData = new FormData(form);

                try {
                    const response = await fetch(routeUrl, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                            "Accept": "application/json"
                        },
                        body: formData,
                        credentials: "same-origin"
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        alertBox.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                        form.reset();
                        setTimeout(() => {
                            window.location.href = data.redirect;
                        }, 1000);
                    }

                    else {
                        let errorMessages = '';


                        if (data.errors) {
                            Object.values(data.errors).forEach((errorArray) => {
                                errorMessages += `<div>${errorArray[0]}</div>`;
                            });
                        }

                        else if (data.message) {
                            errorMessages = data.message;
                        } else {
                            errorMessages = 'Terjadi kesalahan, silakan coba lagi.';
                        }

                        alertBox.innerHTML = `<div class="alert">${errorMessages}</div>`;
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alertBox.innerHTML = `<div class="alert">Terjadi kesalahan koneksi ke server.</div>`;
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalBtnText;
                }
            });
        }


        handleForm('loginForm', "{{ route('login.process') }}", 'loginAlert');
        handleForm('registerForm', "{{ route('register.process') }}", 'registerAlert');
    </script>


</body>

</html>
