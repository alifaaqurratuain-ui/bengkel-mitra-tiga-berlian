@extends('layouts.customer')

@section('title', 'Detail Booking - Mitra Tiga Berlian')
@section('page-title', 'Detail Booking')
@section('page-subtitle', 'Informasi lengkap booking kendaraan')

@section('content')
<style>
    .detail-card {
        background: #fff;
        border-radius: 16px;
        padding: 28px 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        max-width: 620px;
        margin: 0 auto;
        border: 1px solid #f0ece4;
        transition: all 0.3s ease;
        animation: slideUp 0.5s ease-out forwards;
        opacity: 0;
    }
    .detail-card:hover {
        box-shadow: 0 8px 30px rgba(205,160,74,0.12);
        border-color: #cda04a;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .detail-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 14px;
        border-bottom: 2px solid #cda04a;
    }
    .detail-header h2 {
        font-size: 20px;
        font-weight: 700;
        color: #16213a;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .detail-header h2 i {
        color: #cda04a;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 18px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 700;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    }
    .status-menunggu {
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fde68a;
    }
    .status-dikerjakan {
        background: #dbeafe;
        color: #1e40af;
        border: 1px solid #93c5fd;
    }
    .status-selesai {
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #6ee7b7;
    }
    .status-dibatalkan {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fca5a5;
    }

    .detail-row {
        display: flex;
        padding: 14px 0;
        border-bottom: 1px solid #f3f4f7;
        align-items: center;
    }
    .detail-row:last-child {
        border-bottom: none;
    }
    .detail-label {
        width: 140px;
        font-weight: 600;
        color: #6b7280;
        font-size: 13px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .detail-label i {
        color: #cda04a;
        font-size: 14px;
        width: 18px;
    }
    .detail-value {
        flex: 1;
        color: #16213a;
        font-size: 14px;
        font-weight: 600;
    }

    .detail-value .plat {
        background: #f3f4f7;
        padding: 2px 12px;
        border-radius: 6px;
        font-weight: 700;
        color: #16213a;
        border: 1px solid #e5e7eb;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 22px;
        background: #eef0f4;
        color: #16213a;
        border: none;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-top: 20px;
    }
    .btn-back:hover {
        background: #cda04a;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(205,160,74,0.3);
    }

    .btn-back i {
        transition: transform 0.3s ease;
    }
    .btn-back:hover i {
        transform: translateX(-4px);
    }

    /* Responsive */
    @media (max-width: 600px) {
        .detail-card {
            padding: 18px 16px;
        }
        .detail-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 4px;
        }
        .detail-label {
            width: 100%;
        }
        .detail-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
    }
</style>

<div class="detail-card">
    <!-- Header -->
    <div class="detail-header">
        <h2>
            <i class="fa-solid fa-receipt"></i> Detail Booking
        </h2>
        <span class="status-badge status-{{ $booking->status }}">
            ● {{ ucfirst($booking->status) }}
        </span>
    </div>

    <!-- Informasi Kendaraan -->
    <div class="detail-row">
        <span class="detail-label"><i class="fa-solid fa-car"></i> Kendaraan</span>
        <span class="detail-value">{{ $booking->kendaraan->merk ?? '-' }} {{ $booking->kendaraan->model ?? '' }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label"><i class="fa-solid fa-hashtag"></i> Plat Nomor</span>
        <span class="detail-value"><span class="plat">{{ $booking->kendaraan->plat_nomor ?? '-' }}</span></span>
    </div>

    <!-- Tanggal -->
    <div class="detail-row">
        <span class="detail-label"><i class="fa-solid fa-calendar-day"></i> Tanggal Mulai</span>
        <span class="detail-value">{{ \Carbon\Carbon::parse($booking->tanggal_mulai)->format('d F Y') }}</span>
    </div>

    <div class="detail-row">
        <span class="detail-label"><i class="fa-solid fa-calendar-day"></i> Tanggal Selesai</span>
        <span class="detail-value">{{ \Carbon\Carbon::parse($booking->tanggal_selesai)->format('d F Y') }}</span>
    </div>
    
    <!-- Tanggal Booking -->
    <div class="detail-row">
        <span class="detail-label"><i class="fa-regular fa-clock"></i> Tanggal Booking</span>
        <span class="detail-value">{{ \Carbon\Carbon::parse($booking->created_at)->format('d F Y H:i') }}</span>
    </div>

    <!-- Tombol Kembali -->
    <a href="{{ route('customer.booking.index') }}" class="btn-back">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Booking
    </a>
</div>
@endsection