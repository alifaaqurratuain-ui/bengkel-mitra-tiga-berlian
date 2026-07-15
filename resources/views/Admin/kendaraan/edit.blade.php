@extends('layouts.admin')

@section('title', 'Edit Kendaraan - Mitra Tiga Berlian')
@section('page-title', 'Edit Kendaraan')
@section('page-subtitle', 'Update data kendaraan')

@section('content')
<style>
    .form-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 1px 2px rgba(16,24,40,.04), 0 4px 10px rgba(16,24,40,.05);
        max-width: 800px;
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
    <form action="{{ route('admin.kendaraan.update', $kendaraan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group">
                <label>Plat Nomor <span class="required">*</span></label>
                <div class="input-wrap">
                    <i class="fa-solid fa-hashtag"></i>
                    <input type="text" name="plat_nomor" placeholder="B 1234 XYZ" value="{{ old('plat_nomor', $kendaraan->plat_nomor) }}" required>
                </div>
                @error('plat_nomor')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Merk <span class="required">*</span></label>
                <div class="input-wrap">
                    <i class="fa-solid fa-tag"></i>
                    <input type="text" name="merk" placeholder="Toyota" value="{{ old('merk', $kendaraan->merk) }}" required>
                </div>
                @error('merk')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Model <span class="required">*</span></label>
                <div class="input-wrap">
                    <i class="fa-solid fa-car"></i>
                    <input type="text" name="model" placeholder="Avanza" value="{{ old('model', $kendaraan->model) }}" required>
                </div>
                @error('model')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Warna <span class="required">*</span></label>
                <div class="input-wrap">
                    <i class="fa-solid fa-palette"></i>
                    <input type="text" name="warna" placeholder="Hitam" value="{{ old('warna', $kendaraan->warna) }}" required>
                </div>
                @error('warna')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Tahun <span class="required">*</span></label>
                <div class="input-wrap">
                    <i class="fa-solid fa-calendar"></i>
                    <input type="number" name="tahun" placeholder="2020" value="{{ old('tahun', $kendaraan->tahun) }}" required>
                </div>
                @error('tahun')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Tipe <span class="required">*</span></label>
                <div class="input-wrap">
                    <i class="fa-solid fa-truck"></i>
                    <select name="tipe" required>
                        <option value="">Pilih Tipe</option>
                        <option value="mobil" {{ old('tipe', $kendaraan->tipe) == 'mobil' ? 'selected' : '' }}>Mobil</option>
                        <option value="motor" {{ old('tipe', $kendaraan->tipe) == 'motor' ? 'selected' : '' }}>Motor</option>
                        <option value="truk" {{ old('tipe', $kendaraan->tipe) == 'truk' ? 'selected' : '' }}>Truk</option>
                    </select>
                </div>
                @error('tipe')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Harga Sewa/Hari <span class="required">*</span></label>
                <div class="input-wrap">
                    <i class="fa-solid fa-money-bill"></i>
                    <input type="number" name="harga_sewa_per_hari" placeholder="500000" value="{{ old('harga_sewa_per_hari', $kendaraan->harga_sewa_per_hari) }}" required>
                </div>
                @error('harga_sewa_per_hari')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Status <span class="required">*</span></label>
                <div class="input-wrap">
                    <i class="fa-solid fa-circle"></i>
                    <select name="status" required>
                        <option value="">Pilih Status</option>
                        <option value="tersedia" {{ old('status', $kendaraan->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="disewa" {{ old('status', $kendaraan->status) == 'disewa' ? 'selected' : '' }}>Disewa</option>
                        <option value="service" {{ old('status', $kendaraan->status) == 'service' ? 'selected' : '' }}>Service</option>
                    </select>
                </div>
                @error('status')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <div class="input-wrap">
                <i class="fa-solid fa-align-left" style="top: 16px; transform: none;"></i>
                <textarea name="deskripsi" placeholder="Deskripsi kendaraan" style="padding-left: 42px;">{{ old('deskripsi', $kendaraan->deskripsi) }}</textarea>
            </div>
            @error('deskripsi')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-gold">
                <i class="fa-solid fa-floppy-disk"></i> Update Kendaraan
            </button>
            <a href="{{ route('admin.kendaraan.index') }}" class="btn btn-outline">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>
@endsection