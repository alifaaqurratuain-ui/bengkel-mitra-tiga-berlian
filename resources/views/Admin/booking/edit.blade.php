@extends('layouts.admin')

@section('title', 'Edit Booking - Mitra Tiga Berlian')
@section('page-title', 'Edit Booking')
@section('page-subtitle', 'Update data booking')

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
    .form-group select,
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
        padding-left: 14px;
        resize: vertical;
        min-height: 80px;
    }
    .form-group select {
        padding-left: 42px;
        appearance: none;
        cursor: pointer;
    }
    .form-group input:focus,
    .form-group select:focus,
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
    <form action="{{ route('admin.booking.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group">
                <label>Customer <span class="required">*</span></label>
                <div class="input-wrap">
                    <i class="fa-solid fa-user"></i>
                    <select name="user_id" required>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ old('user_id', $booking->user_id) == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }} - {{ $customer->email }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('user_id')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Kendaraan <span class="required">*</span></label>
                <div class="input-wrap">
                    <i class="fa-solid fa-car"></i>
                    <select name="kendaraan_id" required>
                        @foreach($kendaraans as $kendaraan)
                            <option value="{{ $kendaraan->id }}" {{ old('kendaraan_id', $booking->kendaraan_id) == $kendaraan->id ? 'selected' : '' }}>
                                {{ $kendaraan->plat_nomor }} - {{ $kendaraan->merk }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('kendaraan_id')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Tanggal Mulai <span class="required">*</span></label>
                <div class="input-wrap">
                    <i class="fa-solid fa-calendar-day"></i>
                    <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', $booking->tanggal_mulai) }}" required>
                </div>
                @error('tanggal_mulai')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Tanggal Selesai <span class="required">*</span></label>
                <div class="input-wrap">
                    <i class="fa-solid fa-calendar-day"></i>
                    <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $booking->tanggal_selesai) }}" required>
                </div>
                @error('tanggal_selesai')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Keperluan</label>
            <div class="input-wrap">
                <i class="fa-solid fa-align-left" style="top: 16px; transform: none;"></i>
                <textarea name="keperluan" placeholder="Keperluan booking" style="padding-left: 42px;">{{ old('keperluan', $booking->keperluan) }}</textarea>
            </div>
            @error('keperluan')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-gold">
                <i class="fa-solid fa-floppy-disk"></i> Update Booking
            </button>
            <a href="{{ route('admin.booking.index') }}" class="btn btn-outline">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>
@endsection