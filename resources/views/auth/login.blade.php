<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mitra Tiga Berlian</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f6f2;
            position: relative;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }
        .login-card {
            background: #fff;
            border-radius: 24px;
            padding: 40px 36px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.06);
            border: 1px solid rgba(255,255,255,0.4);
        }
        .brand {
            text-align: center;
            margin-bottom: 32px;
        }
        .brand .logo-icon {
            width: 72px;
            height: 72px;
            margin: 0 auto 12px;
            background: linear-gradient(135deg, #d4af37, #b8942f);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #fff;
        }
        .brand h1 {
            font-size: 24px;
            font-weight: 800;
            color: #1a1a2e;
        }
        .brand h1 span {
            background: linear-gradient(135deg, #d4af37, #b8942f);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .brand p {
            font-size: 14px;
            color: #8a8a9e;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #2d2d44;
            margin-bottom: 6px;
        }
        .input-wrap {
            position: relative;
        }
        .input-wrap input {
            width: 100%;
            padding: 14px 44px 14px 16px;
            border: 2px solid #e8e4dc;
            border-radius: 12px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: #1a1a2e;
            background: #fbfbfc;
            transition: all 0.3s ease;
            outline: none;
        }
        .input-wrap input:focus {
            border-color: #d4af37;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.1);
        }
        .toggle-btn {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #b0b0c4;
            cursor: pointer;
            font-size: 18px;
            padding: 4px;
        }
        .toggle-btn:hover {
            color: #d4af37;
        }
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        .form-options .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #5a5a72;
            cursor: pointer;
        }
        .form-options .forgot-link {
            font-size: 13px;
            color: #d4af37;
            text-decoration: none;
        }
        .btn-login {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            color: #fff;
            background: linear-gradient(135deg, #d4af37, #b8942f);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(212, 175, 55, 0.35);
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-card">
        <!-- Brand -->
        <div class="brand">
            <div class="logo-icon"><i class="fas fa-car-side"></i></div>
            <h1>Mitra Tiga <span>Berlian</span></h1>
            <p>Bengkel &amp; Rental</p>
        </div>

        @if($errors->any())
        <div class="error-message">
            <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-wrap">
                    <input type="email" id="email" name="email" 
                           placeholder="admin@bengkel.com" 
                           value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrap">
                    <input type="password" id="password" name="password" 
                           placeholder="Masukkan password" required>
                    <button type="button" class="toggle-btn" onclick="togglePassword()">
                        <i class="fa-regular fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <div class="form-options">
                <label class="remember">
                    <input type="checkbox" name="remember">
                    Ingat saya
                </label>
               <a href="https://wa.me/081517351754" class="forgot-link" target="_blank">
    <i class="fab fa-whatsapp"></i> Lupa password? Hubungi admin
</a>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-arrow-right-to-bracket"></i> Login
            </button>
        </form>
    </div>
</div>

<script>
    function togglePassword() {
        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        
        if (password.type === 'password') {
            password.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            password.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }
</script>

</body>
</html>