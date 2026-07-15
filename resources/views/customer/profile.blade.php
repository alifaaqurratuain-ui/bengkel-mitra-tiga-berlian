@extends('layouts.customer')

@section('title', 'Profile - Mitra Tiga Berlian')
@section('page-title', 'Profile')
@section('page-subtitle', 'Kelola data diri anda')

@section('content')
<style>
    .profile-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 1px 2px rgba(16,24,40,.04), 0 4px 10px rgba(16,24,40,.05);
        max-width: 600px;
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
    .form-group input {
        width: 100%;
        padding: 11px 14px;
        border: 1.5px solid #e2e5eb;
        border-radius: 10px;
        font-size: 13.5px;
        font-family: 'Inter', sans-serif;
        color: #16213a;
        background: #fbfbfc;
        transition: all 0.3s ease;
        outline: none;
    }
    .form-group input:focus {
        border-color: #cda04a;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(205,160,74,0.1);
    }
    .form-group input:disabled {
        background: #f3f4f7;
        cursor: not-allowed;
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
    .alert-success {
        background: #d1fae5;
        color: #065f46;
        padding: 12px 16px;
        border-radius: 10px;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .avatar-large {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #e9b65c, #c98f2c);
        color: #fff;
        font-weight: 700;
        font-size: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }
    .profile-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 24px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eceef2;
    }
    .profile-header .info h2 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #16213a;
    }
    .profile-header .info p {
        margin: 2px 0 0;
        color: #6b7280;
        font-size: 13px;
    }
    @media (max-width: 600px) {
        .profile-header {
            flex-direction: column;
            text-align: center;
        }
        .profile-card {
            padding: 16px;
        }
    }
</style>

<div class="profile-card">
    @if(session('success'))
    <div class="alert-success">
        <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <div class="profile-header">
        <div class="avatar-large">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</div>
        <div class="info">
            <h2>{{ Auth::user()->name }}</h2>
            <p>{{ Auth::user()->email }}</p>
            <p style="font-size:12px;color:#9aa1ae;">Role: Customer</p>
        </div>
    </div>

    <form action="{{ route('customer.profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required>
            @error('name')
                <small style="color:#e34850;">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" value="{{ Auth::user()->email }}" disabled>
        </div>

        <div class="form-group">
            <label>No. HP</label>
            <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}" placeholder="08xx xxxx xxxx">
            @error('phone')
                <small style="color:#e34850;">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="address" value="{{ old('address', Auth::user()->address) }}" placeholder="Alamat lengkap">
            @error('address')
                <small style="color:#e34850;">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-gold">
                <i class="fa-solid fa-save"></i> Update Profile
            </button>
        </div>
    </form>
</div>
@endsection