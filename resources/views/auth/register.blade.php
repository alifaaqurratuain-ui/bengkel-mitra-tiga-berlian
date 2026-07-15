<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - Mitra Tiga Berlian</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* ===== RESET ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f6f2;
            overflow: hidden;
            position: relative;
        }
        
        /* ===== ANIMASI BACKGROUND ===== */
        .bg-animation {
            position: fixed;
            inset: 0;
            z-index: 0;
            background: linear-gradient(135deg, #f8f6f2 0%, #f0ece4 50%, #e8e0d4 100%);
        }
        
        .bg-animation .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(212, 175, 55, 0.05);
            animation: floatCircle 15s ease-in-out infinite;
        }
        
        .bg-animation .circle:nth-child(1) {
            width: 350px;
            height: 350px;
            top: -120px;
            right: -120px;
            animation-delay: 0s;
            background: rgba(212, 175, 55, 0.08);
        }
        
        .bg-animation .circle:nth-child(2) {
            width: 250px;
            height: 250px;
            bottom: -80px;
            left: -80px;
            animation-delay: -5s;
            background: rgba(212, 175, 55, 0.06);
        }
        
        .bg-animation .circle:nth-child(3) {
            width: 180px;
            height: 180px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: -10s;
            background: rgba(212, 175, 55, 0.04);
        }
        
        @keyframes floatCircle {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            25% {
                transform: translate(30px, -30px) scale(1.1);
            }
            50% {
                transform: translate(-20px, 20px) scale(0.9);
            }
            75% {
                transform: translate(15px, -15px) scale(1.05);
            }
        }
        
        /* ===== DECORATIVE LINES ===== */
        .deco-line {
            position: fixed;
            z-index: 0;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.1), transparent);
        }
        
        .deco-line:nth-child(1) {
            top: 20%;
            left: -50%;
            width: 200%;
            height: 1px;
            transform: rotate(-5deg);
        }
        
        .deco-line:nth-child(2) {
            bottom: 25%;
            right: -50%;
            width: 200%;
            height: 1px;
            transform: rotate(3deg);
        }
        
        /* ===== REGISTER CONTAINER ===== */
        .register-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 460px;
            padding: 20px;
            animation: slideUp 0.8s ease-out forwards;
            opacity: 0;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* ===== REGISTER CARD ===== */
        .register-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 36px 32px 32px;
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.06),
                0 8px 24px rgba(0, 0, 0, 0.04),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.4);
            transition: all 0.4s ease;
        }
        
        .register-card:hover {
            box-shadow: 
                0 30px 80px rgba(0, 0, 0, 0.08),
                0 10px 30px rgba(0, 0, 0, 0.05),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
            transform: translateY(-2px);
        }
        
        /* ===== LOGO / BRAND ===== */
        .brand {
            text-align: center;
            margin-bottom: 28px;
        }
        
        .brand .logo-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 10px;
            background: linear-gradient(135deg, #d4af37, #b8942f);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            color: #fff;
            box-shadow: 0 8px 24px rgba(212, 175, 55, 0.25);
            animation: pulseLogo 3s ease-in-out infinite;
        }
        
        @keyframes pulseLogo {
            0%, 100% {
                box-shadow: 0 8px 24px rgba(212, 175, 55, 0.25);
            }
            50% {
                box-shadow: 0 12px 40px rgba(212, 175, 55, 0.35);
            }
        }
        
        .brand h1 {
            font-size: 22px;
            font-weight: 800;
            color: #1a1a2e;
            letter-spacing: -0.5px;
        }
        
        .brand h1 span {
            background: linear-gradient(135deg, #d4af37, #b8942f);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .brand p {
            font-size: 13px;
            color: #8a8a9e;
            font-weight: 400;
            margin-top: 2px;
        }
        
        /* ===== FORM ===== */
        .form-group {
            margin-bottom: 16px;
            position: relative;
        }
        
        .form-group label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: #2d2d44;
            margin-bottom: 5px;
        }
        
        .form-group .input-wrap {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .form-group .input-wrap i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #b0b0c4;
            font-size: 15px;
            transition: all 0.3s ease;
            pointer-events: none;
        }
        
        .form-group .input-wrap input {
            width: 100%;
            padding: 12px 14px 12px 42px;
            border: 2px solid #e8e4dc;
            border-radius: 12px;
            font-size: 13.5px;
            font-family: 'Inter', sans-serif;
            color: #1a1a2e;
            background: rgba(255, 255, 255, 0.6);
            transition: all 0.3s ease;
            outline: none;
        }
        
        .form-group .input-wrap input:focus {
            border-color: #d4af37;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.1);
            transform: translateY(-1px);
        }
        
        .form-group .input-wrap input:focus + i,
        .form-group .input-wrap input:focus ~ i {
            color: #d4af37;
        }
        
        .form-group .input-wrap input::placeholder {
            color: #b8b8cc;
            font-weight: 300;
        }
        
        .form-group .input-wrap .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #b0b0c4;
            cursor: pointer;
            font-size: 15px;
            transition: all 0.3s ease;
            padding: 4px;
        }
        
        .form-group .input-wrap .toggle-password:hover {
            color: #d4af37;
        }
        
        /* ===== NAME ROW ===== */
        .name-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }
        
        /* ===== ERROR ===== */
        .error-text {
            font-size: 11.5px;
            color: #dc2626;
            margin-top: 4px;
            display: block;
        }
        
        .input-error {
            border-color: #dc2626 !important;
            background: #fef2f2 !important;
        }
        
        .input-error:focus {
            border-color: #dc2626 !important;
            box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.1) !important;
        }
        
        .error-message {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 12px;
            padding: 10px 16px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #dc2626;
            font-size: 13px;
            font-weight: 500;
            animation: shake 0.5s ease-out;
        }
        
        .error-message i {
            font-size: 16px;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20% { transform: translateX(-8px); }
            40% { transform: translateX(8px); }
            60% { transform: translateX(-6px); }
            80% { transform: translateX(6px); }
        }
        
        /* ===== BUTTON ===== */
        .btn-register {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            color: #fff;
            background: linear-gradient(135deg, #d4af37, #b8942f);
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(212, 175, 55, 0.25);
            margin-top: 4px;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(212, 175, 55, 0.35);
        }
        
        .btn-register:active {
            transform: translateY(0);
        }
        
        .btn-register .btn-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .btn-register .btn-content i {
            font-size: 17px;
            transition: transform 0.3s ease;
        }
        
        .btn-register:hover .btn-content i {
            transform: translateX(4px);
        }
        
        /* ===== SHIMMER EFFECT ===== */
        .btn-register::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }
        
        .btn-register:hover::before {
            transform: translateX(100%);
        }
        
        /* ===== LOGIN LINK ===== */
        .login-link {
            text-align: center;
            margin-top: 18px;
            font-size: 13.5px;
            color: #5a5a72;
        }
        
        .login-link a {
            color: #d4af37;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .login-link a:hover {
            color: #b8942f;
            text-decoration: underline;
        }
        
        /* ===== GOLD SPARKLE ===== */
        .sparkle {
            position: fixed;
            pointer-events: none;
            animation: sparkleFade 2s ease-out forwards;
        }
        
        @keyframes sparkleFade {
            0% {
                opacity: 1;
                transform: scale(1) rotate(0deg);
            }
            100% {
                opacity: 0;
                transform: scale(0) rotate(180deg);
            }
        }
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 480px) {
            .register-container {
                padding: 12px;
            }
            
            .register-card {
                padding: 24px 18px 20px;
                border-radius: 20px;
            }
            
            .brand .logo-icon {
                width: 54px;
                height: 54px;
                font-size: 22px;
            }
            
            .brand h1 {
                font-size: 19px;
            }
            
            .name-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
            
            .form-group {
                margin-bottom: 14px;
            }
        }
    </style>
</head>
<body>

<!-- ===== BACKGROUND ANIMATION ===== -->
<div class="bg-animation">
    <div class="circle"></div>
    <div class="circle"></div>
    <div class="circle"></div>
</div>
<div class="deco-line"></div>
<div class="deco-line"></div>

<!-- ===== REGISTER CONTAINER ===== -->
<div class="register-container">
    <div class="register-card">
        
        <!-- Brand -->
        <div class="brand">
            <div class="logo-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <h1>Mitra Tiga <span>Berlian</span></h1>
            
        </div>
        
        <!-- Error Message -->
        @if($errors->any())
        <div class="error-message">
            <i class="fas fa-exclamation-circle"></i>
            {{ $errors->first() }}
        </div>
        @endif
        
        <!-- Form -->
        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf
            
            <div class="name-row">
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <div class="input-wrap">
                        <input type="text" id="name" name="name" 
                               placeholder="Nama lengkap" 
                               value="{{ old('name') }}" required autofocus>
                        <i class="fas fa-user"></i>
                    </div>
                    @error('name')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="phone">No. HP</label>
                    <div class="input-wrap">
                        <input type="text" id="phone" name="phone" 
                               placeholder="08xx xxxx xxxx" 
                               value="{{ old('phone') }}">
                        <i class="fas fa-phone"></i>
                    </div>
                    @error('phone')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <div class="input-wrap">
                    <input type="email" id="email" name="email" 
                           placeholder="nama@email.com" 
                           value="{{ old('email') }}" required>
                    <i class="fas fa-envelope"></i>
                </div>
                @error('email')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrap">
                    <input type="password" id="password" name="password" 
                           placeholder="Minimal 8 karakter" required>
                    <i class="fas fa-lock"></i>
                    <button type="button" class="toggle-password" onclick="togglePassword('password', 'eyeIcon1')">
                        <i class="fas fa-eye" id="eyeIcon1"></i>
                    </button>
                </div>
                @error('password')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <div class="input-wrap">
                    <input type="password" id="password_confirmation" name="password_confirmation" 
                           placeholder="Ketik ulang password" required>
                    <i class="fas fa-check-circle"></i>
                    <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation', 'eyeIcon2')">
                        <i class="fas fa-eye" id="eyeIcon2"></i>
                    </button>
                </div>
            </div>
            
            <button type="submit" class="btn-register" id="registerBtn">
                <span class="btn-content">
                    <span>Daftar Sekarang</span>
                    <i class="fas fa-arrow-right"></i>
                </span>
            </button>
        </form>
        
        <div class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
        
    </div>
</div>

<script>
    // ===== TOGGLE PASSWORD =====
    function togglePassword(inputId, eyeId) {
        const input = document.getElementById(inputId);
        const eye = document.getElementById(eyeId);
        
        if (input.type === 'password') {
            input.type = 'text';
            eye.classList.remove('fa-eye');
            eye.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            eye.classList.remove('fa-eye-slash');
            eye.classList.add('fa-eye');
        }
    }
    
    // ===== GOLD SPARKLE EFFECT =====
    document.getElementById('registerBtn').addEventListener('click', function(e) {
        for (let i = 0; i < 14; i++) {
            const sparkle = document.createElement('div');
            sparkle.className = 'sparkle';
            sparkle.innerHTML = '✦';
            sparkle.style.cssText = `
                position: fixed;
                color: #d4af37;
                font-size: ${Math.random() * 14 + 6}px;
                left: ${e.clientX + (Math.random() - 0.5) * 140}px;
                top: ${e.clientY + (Math.random() - 0.5) * 140}px;
                pointer-events: none;
                z-index: 999;
                animation: sparkleFade ${Math.random() * 1 + 1}s ease-out forwards;
            `;
            document.body.appendChild(sparkle);
            setTimeout(() => sparkle.remove(), 2000);
        }
    });
    
    // ===== FLOATING LABEL EFFECT =====
    document.querySelectorAll('.input-wrap input').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.01)';
        });
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    });
    
    // ===== PASSWORD STRENGTH INDICATOR (Bonus) =====
    document.getElementById('password').addEventListener('input', function() {
        const val = this.value;
        const strength = document.getElementById('passwordStrength');
        
        if (!strength) {
            const div = document.createElement('div');
            div.id = 'passwordStrength';
            div.style.cssText = 'margin-top: 4px; font-size: 11px; font-weight: 500;';
            this.parentElement.parentElement.appendChild(div);
        }
        
        const el = document.getElementById('passwordStrength');
        if (val.length === 0) {
            el.textContent = '';
            el.style.color = '';
        } else if (val.length < 4) {
            el.textContent = '● Terlalu pendek';
            el.style.color = '#dc2626';
        } else if (val.length < 8) {
            el.textContent = '●●● Lemah';
            el.style.color = '#f59e0b';
        } else if (val.length < 12) {
            el.textContent = '●●●●● Sedang';
            el.style.color = '#3b82f6';
        } else {
            el.textContent = '●●●●●●● Kuat!';
            el.style.color = '#22c55e';
        }
    });
</script>

</body>
</html>