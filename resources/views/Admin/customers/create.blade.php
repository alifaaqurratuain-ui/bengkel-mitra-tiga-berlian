@extends('layouts.admin')

@section('title', 'Tambah Customer - Mitra Tiga Berlian')
@section('page-title', 'Tambah Customer')
@section('page-subtitle', 'Lengkapi data customer baru')

@section('content')
<style>
    .form-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 1px 2px rgba(16,24,40,.04), 0 4px 10px rgba(16,24,40,.05);
        max-width: 700px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #16213a;
        margin-bottom: 6px;
    }
    .form-group label .required {
        color: #e34850;
        margin-left: 2px;
    }
    .form-group .input-wrap {
        position: relative;
    }
    .form-group .input-wrap i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #9aa1ae;
        font-size: 15px;
    }
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 11px 14px 11px 42px;
        border: 1.5px solid #e2e5eb;
        border-radius: 10px;
        font-size: 13.5px;
        font-family: 'Inter', sans-serif;
        color: #16213a;
        background: #fbfbfc;
        transition: all 0.3s ease;
        outline: none;
    }
    .form-group textarea {
        padding-left: 42px;
        resize: vertical;
        min-height: 80px;
    }
    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #cda04a;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(205,160,74,0.1);
    }
    .form-group .error-text {
        color: #e34850;
        font-size: 12px;
        margin-top: 4px;
        display: block;
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 8px;
        padding-top: 20px;
        border-top: 1px solid #eceef2;
    }
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 24px;
        border: none;
        border-radius: 10px;
        font-size: 13.5px;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .btn-gold {
        background: linear-gradient(135deg, #d3b15c, #b08c3c);
        color: #2c2410;
    }
    .btn-gold:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(205,160,74,0.3);
    }
    .btn-outline {
        background: #fff;
        border: 1.5px solid #e2e5eb;
        color: #6b7280;
    }
    .btn-outline:hover {
        border-color: #cda04a;
        color: #cda04a;
    }
    .toggle-btn {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #9aa1ae;
        cursor: pointer;
        font-size: 16px;
        padding: 4px;
        border-radius: 6px;
        transition: all 0.3s ease;
    }
    .toggle-btn:hover {
        color: #cda04a;
        background: rgba(205,160,74,0.1);
    }
    @media (max-width: 600px) {
        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }
        .form-card {
            padding: 16px;
        }
    }
</style>

<div class="form-card">
    <form action="{{ route('admin.customers.store') }}" method="POST">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label>Nama Lengkap <span class="required">*</span></label>
                <div class="input-wrap">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="name" placeholder="Contoh: Budi Santoso" value="{{ old('name') }}" required>
                </div>
                @error('name')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>No. HP <span class="required">*</span></label>
                <div class="input-wrap">
                    <i class="fa-solid fa-phone"></i>
                    <input type="text" name="phone" placeholder="08xx xxxx xxxx" value="{{ old('phone') }}" required>
                </div>
                @error('phone')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Email <span class="required">*</span></label>
                <div class="input-wrap">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="email" placeholder="nama@email.com" value="{{ old('email') }}" required>
                </div>
                @error('email')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Password <span class="required">*</span></label>
                <div class="input-wrap">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Minimal 3 karakter" required>
                    <button type="button" class="toggle-btn" onclick="togglePassword('password', 'eyeIcon1')">
                        <i class="fa-solid fa-eye" id="eyeIcon1"></i>
                    </button>
                </div>
                @error('password')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- ===== KELUHAN (TANPA ICON, RAPI) ===== -->
        <div class="form-group">
            <label>Keluhan</label>
            <textarea name="address" placeholder="Tulis keluhan customer" style="width:100%;padding:11px 14px;border:1.5px solid #e2e5eb;border-radius:10px;font-size:13.5px;font-family:'Inter',sans-serif;color:#16213a;background:#fbfbfc;transition:all 0.3s ease;outline:none;resize:vertical;min-height:80px;">{{ old('address') }}</textarea>
            @error('address')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-gold">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Customer
            </button>
            <a href="{{ route('admin.customers.index') }}" class="btn btn-outline">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>

<script>
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
</script>
@endsection