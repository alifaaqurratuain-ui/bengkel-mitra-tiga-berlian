@extends('layouts.customer')

@section('title', 'Dashboard - Mitra Tiga Berlian')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'yuk lihat aktifitas kendaraan anda!')

@section('content')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 24px;
    }
    .stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 18px 20px;
        box-shadow: 0 1px 2px rgba(16,24,40,.04), 0 4px 10px rgba(16,24,40,.05);
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
    }
    .stat-info p.label {
        margin: 0;
        font-size: 12.5px;
        font-weight: 600;
        color: #6b7280;
    }
    .stat-info .value {
        font-size: 28px;
        font-weight: 800;
        color: #16213a;
        margin: 6px 0 4px;
        line-height: 1;
    }
    .stat-info .desc {
        font-size: 11.5px;
        color: #9aa1ae;
        font-weight: 500;
    }
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }
    .icon-teal { background: #d9f8fa; color: #11808a; }
    .icon-yellow { background: #fff3ae; color: #b3860c; }
    .icon-green { background: #d1fae5; color: #065f46; }

    .card {
        background: #fff;
        border-radius: 16px;
        padding: 22px 24px;
        box-shadow: 0 1px 2px rgba(16,24,40,.04), 0 4px 10px rgba(16,24,40,.05);
        margin-bottom: 24px;
    }
    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
    }
    .card-header .title {
        display: flex;
        align-items: center;
        gap: 9px;
        font-size: 15.5px;
        font-weight: 700;
        color: #16213a;
    }
    .card-header .title i { color: #a9842f; font-size: 15px; }
    .card-header .link {
        font-size: 13px;
        font-weight: 700;
        color: #a9842f;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .card-header .link:hover { color: #cda04a; }

    .booking-row {
        display: grid;
        grid-template-columns: 1.5fr 1.5fr 1.2fr 1fr 1fr;
        padding: 12px 4px;
        border-bottom: 1px solid #f3f4f7;
        font-size: 13px;
        align-items: center;
    }
    .booking-row:last-child { border-bottom: none; }
    .booking-row span { color: #16213a; }

    .status-badge {
        display: inline-block;
        padding: 3px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }
    .status-menunggu { background: #fef3c7; color: #92400e; }
    .status-dikerjakan { background: #dbeafe; color: #1e40af; }
    .status-selesai { background: #d1fae5; color: #065f46; }
    .status-dibatalkan { background: #fee2e2; color: #991b1b; }

    .empty-state {
        padding: 40px 20px;
        text-align: center;
    }
    .empty-state i {
        font-size: 34px;
        color: #cfd3da;
        display: block;
        margin-bottom: 14px;
    }
    .empty-state .headline {
        font-size: 14px;
        font-weight: 700;
        color: #5d6472;
        margin: 0;
    }
    .empty-state .hint {
        font-size: 12.5px;
        color: #9aa1ae;
        margin: 6px 0 0;
    }

    /* ===== ANIMASI UNTUK CUSTOMER DASHBOARD ===== */
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .stat-card {
        animation: slideUp 0.6s ease-out forwards;
        opacity: 0;
    }
    .stat-card:nth-child(1) { animation-delay: 0.05s; }
    .stat-card:nth-child(2) { animation-delay: 0.1s; }
    .stat-card:nth-child(3) { animation-delay: 0.15s; }

    .stat-card:hover {
        transform: translateY(-4px);
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }

    .stat-card .value {
        transition: all 0.3s ease;
    }
    .stat-card:hover .value {
        animation: pulse 0.5s ease-in-out;
    }

    .banner-welcome {
        animation: slideUp 0.5s ease-out forwards;
        opacity: 0;
        animation-delay: 0.1s;
    }

    .card {
        animation: slideUp 0.6s ease-out forwards;
        opacity: 0;
        animation-delay: 0.2s;
    }

    @media (max-width: 760px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        .booking-row {
            grid-template-columns: 1fr;
            gap: 4px;
            padding: 16px 4px;
        }
    }
</style>

<!-- Welcome Banner -->
<div class="banner-welcome" style="background:linear-gradient(135deg,#26334f,#1a2438);border-radius:18px;padding:22px 26px;color:#fff;margin-bottom:24px;position:relative;overflow:hidden;">
    <div style="position:absolute;width:260px;height:260px;background:radial-gradient(circle,rgba(255,255,255,.06),transparent 70%);top:-120px;right:-60px;border-radius:50%;"></div>
    <div style="position:relative;z-index:1;">
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
            <div>
                <p style="font-size:15px;font-weight:700;margin:0 0 4px;">Selamat datang, {{ Auth::user()->name }}! 👋</p>
                <p style="font-size:12.5px;color:#aab4c8;margin:0;">Kelola booking & rental kendaraan anda dengan mudah</p>
            </div>
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <span style="display:flex;align-items:center;gap:7px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.14);padding:6px 14px;border-radius:30px;font-size:12px;font-weight:600;">
                    <i class="fa-solid fa-calendar-days" style="color:#cda04a;"></i> {{ date('d F Y') }}
                </span>
                <span style="display:flex;align-items:center;gap:7px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.14);padding:6px 14px;border-radius:30px;font-size:12px;font-weight:600;">
                    <i class="fa-regular fa-clock" style="color:#cda04a;"></i> <span id="bannerClock">{{ date('H:i') }}</span>
                </span>
                <span style="display:flex;align-items:center;gap:7px;background:rgba(52,199,123,.16);border-color:rgba(52,199,123,.3);padding:6px 14px;border-radius:30px;font-size:12px;font-weight:600;color:#7be3a8;">
                    <span class="dot-pulse"></span>
                    Aktif
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Stats -->
<section class="stats-grid">
    <div class="stat-card">
        <div class="stat-info">
            <p class="label">Total Booking</p>
            <p class="value">{{ $totalBooking ?? 0 }}</p>
            <p class="desc">Total pemesanan anda</p>
        </div>
        <div class="stat-icon icon-teal"><i class="fa-solid fa-calendar-check"></i></div>
    </div>
    <div class="stat-card">
        <div class="stat-info">
            <p class="label">Booking Aktif</p>
            <p class="value">{{ $activeBookings ?? 0 }}</p>
            <p class="desc">Sedang berlangsung</p>
        </div>
        <div class="stat-icon icon-yellow"><i class="fa-solid fa-spinner"></i></div>
    </div>
    <div class="stat-card">
        <div class="stat-info">
            <p class="label">Selesai</p>
            <p class="value">{{ $completedBookings ?? 0 }}</p>
            <p class="desc">Booking selesai</p>
        </div>
        <div class="stat-icon icon-green"><i class="fa-solid fa-check-circle"></i></div>
    </div>
</section>

<!-- Riwayat Booking -->
<section class="card">
    <div class="card-header">
        <div class="title"><i class="fa-solid fa-clock-rotate-left"></i> Riwayat Booking</div>
        <a href="{{ route('customer.booking.index') }}" class="link">Lihat semua <i class="fa-solid fa-arrow-right"></i></a>
    </div>

    @forelse($recentBookings ?? [] as $booking)
    <div class="booking-row">
        <span><strong>{{ $booking->kendaraan->plat_nomor ?? '-' }}</strong></span>
        <span>{{ $booking->kendaraan->merk ?? '-' }} {{ $booking->kendaraan->model ?? '' }}</span>
        <span>{{ \Carbon\Carbon::parse($booking->tanggal_mulai)->format('d/m/Y') }}</span>
        <span>
            <span class="status-badge status-{{ $booking->status }}">
                {{ ucfirst($booking->status) }}
            </span>
        </span>
        <span>
            <a href="{{ route('customer.booking.show', $booking->id) }}" style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:8px;border:none;cursor:pointer;text-decoration:none;background:rgba(16,185,129,0.1);color:#10B981;">
                <i class="fa-solid fa-eye"></i>
            </a>
        </span>
    </div>
    @empty
    <div class="empty-state">
        <i class="fa-solid fa-calendar-xmark"></i>
        <p class="headline">Belum ada booking</p>
        <p class="hint">Silakan booking kendaraan melalui admin</p>
    </div>
    @endforelse
</section>
@endsection