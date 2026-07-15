@extends('layouts.admin')

@section('title', 'Tambah Booking - Mitra Tiga Berlian')
@section('page-title', 'Tambah Booking')
@section('page-subtitle', 'Lengkapi data booking baru')

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
    .form-group select,
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
        appearance: none;
        -webkit-appearance: none;
    }
    .form-group select {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236b7280' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        background-size: 12px;
        padding-right: 40px;
        cursor: pointer;
    }
    .form-group select:focus,
    .form-group input:focus {
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
    .alert-error {
        background: #fee2e2;
        color: #991b1b;
        padding: 12px 16px;
        border-radius: 10px;
        margin-bottom: 16px;
    }
    .alert-error ul {
        margin: 4px 0 0 20px;
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
    @if(session('error'))
    <div class="alert-error">
        <i class="fa-solid fa-exclamation-circle"></i> {{ session('error') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert-error">
        <i class="fa-solid fa-exclamation-circle"></i>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.booking.store') }}" method="POST">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label>Customer <span class="required">*</span></label>
                <select name="user_id" required>
    <option value="">-- Pilih Customer --</option>
    @foreach($customers as $customer)
        <option value="{{ $customer->id }}" {{ old('user_id') == $customer->id ? 'selected' : '' }}>
            {{ $customer->name }}
        </option>
    @endforeach
</select>
                @error('user_id')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Kendaraan <span class="required">*</span></label>
                <select name="kendaraan_id" required>
                    <option value="">-- Pilih Kendaraan --</option>
                    @foreach($kendaraans as $kendaraan)
                        <option value="{{ $kendaraan->id }}" {{ old('kendaraan_id') == $kendaraan->id ? 'selected' : '' }}>
                            {{ $kendaraan->plat_nomor }} - {{ $kendaraan->merk }} {{ $kendaraan->model }}
                        </option>
                    @endforeach
                </select>
                @error('kendaraan_id')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Tanggal Mulai <span class="required">*</span></label>
                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required>
                @error('tanggal_mulai')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Tanggal Selesai <span class="required">*</span></label>
                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required>
                @error('tanggal_selesai')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-gold">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Booking
            </button>
            <a href="{{ route('admin.booking.index') }}" class="btn btn-outline">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>
@endsection