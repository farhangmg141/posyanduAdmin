<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login & Register | Aplikasi</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: 
        linear-gradient(135deg, rgba(0, 123, 131, 0.4), rgba(123, 202, 248, 0.3)),
        url("https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p2/218/2024/07/16/SURYANTO-WISATA-KOTA-LAMA-7-947757994.jpg") 
        no-repeat center center fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
      position: relative;
      overflow: hidden;
    }

    body::before {
      content: '';
      position: absolute;
      width: 500px;
      height: 500px;
      background: radial-gradient(circle, rgba(0, 173, 173, 0.15), transparent);
      border-radius: 50%;
      top: -200px;
      right: -200px;
      animation: float 20s infinite ease-in-out;
    }

    body::after {
      content: '';
      position: absolute;
      width: 400px;
      height: 400px;
      background: radial-gradient(circle, rgba(123, 202, 248, 0.15), transparent);
      border-radius: 50%;
      bottom: -150px;
      left: -150px;
      animation: float 15s infinite ease-in-out reverse;
    }

    @keyframes float {
      0%, 100% { transform: translate(0, 0) scale(1); }
      50% { transform: translate(50px, 50px) scale(1.1); }
    }

    .container {
      background: rgba(255, 255, 255, 0.98);
      backdrop-filter: blur(10px);
      border-radius: 30px;
      box-shadow: 
        0 30px 80px rgba(0, 0, 0, 0.3),
        0 0 0 1px rgba(255, 255, 255, 0.3) inset;
      position: relative;
      overflow: hidden;
      width: 950px;
      max-width: 100%;
      min-height: 650px;
      transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
      z-index: 10;
    }

    .container::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: linear-gradient(45deg, transparent, rgba(0, 173, 173, 0.03), transparent);
      transform: rotate(45deg);
      pointer-events: none;
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
      0%, 49.99% { opacity: 0; z-index: 1; }
      50%, 100% { opacity: 1; z-index: 5; }
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
      background: linear-gradient(135deg, #00adad 0%, #4db8e8 50%, #7bcaf8 100%);
      color: white;
      position: relative;
      left: -100%;
      height: 100%;
      width: 200%;
      transform: translateX(0);
      transition: transform 0.6s ease-in-out;
    }

    .overlay::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)" /></svg>');
      opacity: 0.3;
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
      padding: 0 60px;
      text-align: center;
      top: 0;
      height: 100%;
      width: 50%;
      transition: transform 0.6s ease-in-out;
    }

    .overlay-panel::before {
      content: '';
      position: absolute;
      width: 150px;
      height: 150px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      top: 20%;
      right: -50px;
      animation: pulse 3s infinite;
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); opacity: 0.3; }
      50% { transform: scale(1.2); opacity: 0.1; }
    }

    .overlay-panel h1 {
      color: white;
      font-size: 36px;
      font-weight: 700;
      margin-bottom: 20px;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      letter-spacing: -0.5px;
    }

    .overlay-panel p {
      font-size: 16px;
      line-height: 1.8;
      margin-bottom: 30px;
      opacity: 0.95;
      font-weight: 300;
    }

    .overlay-left { transform: translateX(-20%); }
    .container.right-panel-active .overlay-left { transform: translateX(0); }
    .overlay-right { right: 0; transform: translateX(0); }
    .container.right-panel-active .overlay-right { transform: translateX(20%); }

    form {
      background: white;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      padding: 0 70px;
      height: 100%;
      text-align: center;
    }

    .logo-container {
      width: 70px;
      height: 70px;
      background: linear-gradient(135deg, #00adad, #7bcaf8);
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 25px;
      box-shadow: 0 8px 25px rgba(0, 173, 173, 0.3);
      transform: rotate(-5deg);
    }

    .logo-container svg {
      width: 40px;
      height: 40px;
      fill: white;
    }

    h1 {
      font-weight: 700;
      margin-bottom: 10px;
      color: #007b83;
      font-size: 32px;
      letter-spacing: -1px;
    }

    .form-subtitle {
      font-size: 14px;
      color: #7a7a7a;
      margin-bottom: 30px;
      font-weight: 400;
    }

    .input-group {
      width: 100%;
      margin-bottom: 18px;
      position: relative;
    }

    .input-icon {
      position: absolute;
      left: 18px;
      top: 50%;
      transform: translateY(-50%);
      color: #999;
      font-size: 18px;
      z-index: 1;
    }

    input {
      background: #f8f9fa;
      border: 2px solid #e8ecef;
      padding: 16px 20px 16px 50px;
      width: 100%;
      border-radius: 14px;
      font-size: 15px;
      transition: all 0.3s ease;
      color: #333;
      font-family: 'Poppins', sans-serif;
      font-weight: 400;
    }

    input::placeholder {
      color: #aaa;
    }

    input:focus {
      outline: none;
      background: #ffffff;
      border-color: #00adad;
      box-shadow: 0 0 0 4px rgba(0, 173, 173, 0.08);
      transform: translateY(-2px);
    }

    button {
      border-radius: 14px;
      border: none;
      background: linear-gradient(135deg, #00adad 0%, #5fc5e8 50%, #7bcaf8 100%);
      color: white;
      font-size: 15px;
      font-weight: 600;
      padding: 16px 55px;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
      cursor: pointer;
      margin-top: 25px;
      box-shadow: 0 8px 25px rgba(0, 173, 173, 0.35);
      position: relative;
      overflow: hidden;
      font-family: 'Poppins', sans-serif;
    }

    button::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
      transition: left 0.5s;
    }

    button:hover::before {
      left: 100%;
    }

    button:hover {
      background: linear-gradient(135deg, #009999 0%, #4db8e8 50%, #6abaf2 100%);
      transform: translateY(-3px) scale(1.02);
      box-shadow: 0 12px 35px rgba(0, 173, 173, 0.45);
    }

    button:active {
      transform: translateY(-1px) scale(0.98);
    }

    button:disabled {
      opacity: 0.7;
      cursor: not-allowed;
      transform: none !important;
    }

    button.ghost {
      background: transparent;
      border: 2px solid white;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      backdrop-filter: blur(5px);
    }

    button.ghost:hover {
      background: rgba(255, 255, 255, 0.25);
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }

    a {
      color: #00adad;
      font-size: 14px;
      text-decoration: none;
      margin: 18px 0 5px;
      transition: all 0.3s ease;
      font-weight: 500;
      position: relative;
    }

    a::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 0;
      height: 2px;
      background: #00adad;
      transition: width 0.3s ease;
    }

    a:hover::after {
      width: 100%;
    }

    a:hover {
      color: #008a8a;
    }

    .alert {
      background: linear-gradient(135deg, #fee 0%, #fdd 100%);
      color: #c33;
      padding: 14px 22px;
      border-radius: 12px;
      font-size: 14px;
      margin-bottom: 20px;
      width: 100%;
      text-align: center;
      border: 1px solid rgba(204, 51, 51, 0.2);
      animation: slideIn 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
      box-shadow: 0 4px 15px rgba(204, 51, 51, 0.15);
      font-weight: 500;
    }

    .alert-success {
      background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
      color: #155724;
      border: 1px solid rgba(21, 87, 36, 0.2);
      box-shadow: 0 4px 15px rgba(21, 87, 36, 0.15);
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(-20px) scale(0.9);
      }
      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    /* Icon styles */
    .icon {
      display: inline-block;
      width: 18px;
      height: 18px;
    }

    /* Mobile Toggle */
    .mobile-toggle {
      display: none;
      margin-top: 25px;
      font-size: 14px;
      color: #666;
      font-weight: 400;
    }

    .mobile-toggle a {
      color: #00adad;
      font-weight: 600;
      margin-left: 5px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      body::before,
      body::after {
        display: none;
      }

      .container {
        width: 100%;
        min-height: auto;
        border-radius: 25px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
      }

      .form-container {
        width: 100% !important;
        position: relative;
      }

      .sign-in-container,
      .sign-up-container {
        width: 100% !important;
        position: relative;
      }

      .sign-up-container {
        display: none;
      }

      .container.right-panel-active .sign-in-container {
        display: none;
      }

      .container.right-panel-active .sign-up-container {
        display: flex;
        transform: translateX(0);
      }

      .overlay-container {
        display: none;
      }

      form {
        padding: 50px 35px;
        height: auto;
        min-height: 600px;
      }

      h1 {
        font-size: 28px;
      }

      .mobile-toggle {
        display: flex;
        justify-content: center;
        align-items: center;
      }

      input {
        padding: 14px 18px 14px 45px;
      }

      .logo-container {
        width: 60px;
        height: 60px;
        margin-bottom: 20px;
      }

      .logo-container svg {
        width: 35px;
        height: 35px;
      }
    }

    @media (max-width: 480px) {
      form {
        padding: 40px 25px;
      }

      h1 {
        font-size: 24px;
      }

      button {
        padding: 14px 45px;
        font-size: 14px;
      }
    }
  </style>
</head>
<body>
  <div class="container" id="container">
    <!-- Register Form -->
    <div class="form-container sign-up-container">
      <form id="registerForm">
        <div class="logo-container">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5zm0 10c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/>
          </svg>
        </div>
        <h1>Buat Akun</h1>
        <span class="form-subtitle">Daftarkan diri Anda untuk memulai</span>
        <div id="registerAlert"></div>
        
        <div class="input-group">
          <span class="input-icon">👤</span>
          <input type="text" name="name" placeholder="Nama Lengkap" required>
        </div>
        
        <div class="input-group">
          <span class="input-icon">✉️</span>
          <input type="email" name="email" placeholder="Alamat Email" required>
        </div>
        
        <div class="input-group">
          <span class="input-icon">🔒</span>
          <input type="password" name="password" placeholder="Password (min. 8 karakter)" required minlength="8">
        </div>
        
        <button type="submit">Daftar Sekarang</button>
        
        <div class="mobile-toggle">
          Sudah punya akun?<a href="#" id="mobileSignIn">Masuk di sini</a>
        </div>
      </form>
    </div>

    <!-- Login Form -->
    <div class="form-container sign-in-container">
      <form id="loginForm">
        <div class="logo-container">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5zm0 10c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/>
          </svg>
        </div>
        <h1>Selamat Datang</h1>
        <span class="form-subtitle">Masuk ke akun Anda</span>
        <div id="loginAlert"></div>
        
        <div class="input-group">
          <span class="input-icon">✉️</span>
          <input type="email" name="email" placeholder="Alamat Email" required>
        </div>
        
        <div class="input-group">
          <span class="input-icon">🔒</span>
          <input type="password" name="password" placeholder="Password" required>
        </div>
        
        <a href="#">Lupa password?</a>
        <button type="submit">Masuk</button>
        
        <div class="mobile-toggle">
          Belum punya akun?<a href="#" id="mobileSignUp">Daftar di sini</a>
        </div>
      </form>
    </div>

    <!-- Overlay -->
    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1>Selamat Datang Kembali!</h1>
          <p>Masuk dengan akun Anda untuk melanjutkan perjalanan bersama kami</p>
          <button class="ghost" id="signIn">Masuk</button>
        </div>
        <div class="overlay-panel overlay-right">
          <h1>Halo, Teman!</h1>
          <p>Daftarkan diri Anda dan mulai perjalanan luar biasa bersama kami</p>
          <button class="ghost" id="signUp">Daftar</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    const container = document.getElementById('container');
    
    // Desktop toggle
    document.getElementById('signUp').addEventListener('click', () => {
      container.classList.add('right-panel-active');
    });
    
    document.getElementById('signIn').addEventListener('click', () => {
      container.classList.remove('right-panel-active');
    });

    // Mobile toggle
    document.getElementById('mobileSignUp').addEventListener('click', (e) => {
      e.preventDefault();
      container.classList.add('right-panel-active');
    });
    
    document.getElementById('mobileSignIn').addEventListener('click', (e) => {
      e.preventDefault();
      container.classList.remove('right-panel-active');
    });

    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    async function handleForm(formId, routeUrl, alertId) {
      const form = document.getElementById(formId);
      const submitBtn = form.querySelector('button[type="submit"]');
      const originalBtnText = submitBtn.textContent;

      form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const alertBox = document.getElementById(alertId);
        alertBox.innerHTML = '';
        
        // Disable button during submit
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
            }, 800);
          } else {
            alertBox.innerHTML = `<div class="alert">${data.message || 'Terjadi kesalahan, silakan coba lagi.'}</div>`;
            submitBtn.disabled = false;
            submitBtn.textContent = originalBtnText;
          }
        } catch (error) {
          console.error('Error:', error);
          alertBox.innerHTML = `<div class="alert">Terjadi kesalahan koneksi ke server. Periksa koneksi Anda.</div>`;
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