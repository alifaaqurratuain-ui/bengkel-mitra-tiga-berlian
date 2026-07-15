@extends('layouts.admin')

@section('title', 'Dashboard - Mitra Tiga Berlian')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Kelola bengkel dengan mudah')

@section('content')
<style>
  :root{
    --navy-900:#121a2c;
    --navy-800:#1a2438;
    --navy-700:#202c45;
    --banner-grad-a:#26334f;
    --banner-grad-b:#1a2438;
    --gold:#cda04a;
    --gold-dark:#a9842f;
    --teal-a:#3c6a6f;
    --teal-b:#284648;
    --page-bg:#f3f4f7;
    --text-dark:#16213a;
    --text-gray:#6b7280;
    --text-faint:#9aa1ae;
    --border-soft:#eceef2;
    --radius-lg:16px;
    --radius-md:12px;
    --shadow-card:0 1px 2px rgba(16,24,40,.04), 0 4px 10px rgba(16,24,40,.05);
  }

  *{box-sizing:border-box;}
  body{
    font-family:'Inter',sans-serif;
    background:var(--page-bg);
    color:var(--text-dark);
    -webkit-font-smoothing:antialiased;
  }
  h1,h2,h3,.numeric{font-family:'Plus Jakarta Sans',sans-serif;}

  /* ===== Banner ===== */
  .banner{
    background:linear-gradient(135deg,var(--banner-grad-a),var(--banner-grad-b));
    border-radius:18px;
    padding:22px 26px;
    color:#fff;
    position:relative;
    overflow:hidden;
    margin-bottom:24px;
  }
  .banner::after{
    content:"";
    position:absolute;
    width:260px;height:260px;
    background:radial-gradient(circle, rgba(255,255,255,.06), transparent 70%);
    top:-120px;right:-60px;
    border-radius:50%;
  }
  .banner-top p.greeting{margin:0 0 4px;font-size:15px;font-weight:700;}
  .banner-top p.sub{margin:0 0 16px;font-size:12.5px;color:#aab4c8;}
  .pills{display:flex;gap:10px;flex-wrap:wrap;position:relative;z-index:1;}
  .pill{
    display:flex;align-items:center;gap:7px;
    background:rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.14);
    padding:7px 15px;
    border-radius:30px;
    font-size:12.5px;font-weight:600;
  }
  .pill i{font-size:12px;color:var(--gold);}
  .pill.status{
    background:rgba(52,199,123,.16);
    border-color:rgba(52,199,123,.3);
    color:#7be3a8;
  }
  .pill.status i{color:#7be3a8;}

  /* ===== Stat cards ===== */
  .stats-grid{
    display:grid;
    grid-template-columns:repeat(4, 1fr);
    gap:18px;
    margin-bottom:24px;
  }
  .stat-card{
    background:#fff;
    border-radius:var(--radius-lg);
    padding:18px 20px;
    box-shadow:var(--shadow-card);
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:10px;
  }
  .stat-info p.label{margin:0;font-size:12.5px;font-weight:600;color:var(--text-gray);}
  .stat-info .value{font-size:28px;font-weight:800;color:var(--text-dark);margin:6px 0 4px;line-height:1;}
  .stat-info .desc{font-size:11.5px;color:var(--text-faint);font-weight:500;}
  .stat-info .desc.positive{color:#16a34a;font-weight:700;}
  .stat-icon{
    width:50px;height:50px;border-radius:14px;flex-shrink:0;
    display:flex;align-items:center;justify-content:center;
    font-size:19px;
  }
  .icon-teal{background:#d9f8fa;color:#11808a;}
  .icon-yellow{background:#fff3ae;color:#b3860c;}
  .icon-pink{background:#ffeef5;color:#9c1c50;}
  .icon-dark{background:#262a35;color:#fff;}

  /* ===== Card shared ===== */
  .card{
    background:#fff;
    border-radius:var(--radius-lg);
    box-shadow:var(--shadow-card);
    padding:22px 24px;
    margin-bottom:24px;
  }
  .card-header{
    display:flex;align-items:center;justify-content:space-between;
    margin-bottom:18px;
  }
  .card-header .title{
    display:flex;align-items:center;gap:9px;
    font-size:15.5px;font-weight:700;color:var(--text-dark);
  }
  .card-header .title i{color:var(--gold-dark);font-size:15px;}
  .card-header .link{
    font-size:13px;font-weight:700;color:var(--gold-dark);
    text-decoration:none;display:flex;align-items:center;gap:5px;
  }
  .card-header .link:hover{color:var(--gold);}

  /* ===== Quick actions ===== */
  .quick-actions{display:flex;gap:16px;}
  .qa-btn{
    flex:1;
    display:flex;align-items:center;justify-content:center;gap:9px;
    padding:14px 18px;
    border:none;border-radius:12px;
    font-size:13.5px;font-weight:700;
    cursor:pointer;
    color:#fff;
    transition:transform .12s, box-shadow .12s;
    text-decoration:none;
  }
  .qa-btn:hover{transform:translateY(-1px);}
  .qa-btn.dark{background:#1d1e24;}
  .qa-btn.teal{background:linear-gradient(135deg,var(--teal-a),var(--teal-b));}
  .qa-btn.gold{background:linear-gradient(135deg,#d3b15c,#b08c3c);color:#2c2410;}

  /* ===== Table ===== */
  .table-head{
    display:grid;
    grid-template-columns:0.5fr 1.5fr 1.5fr 1.2fr 1fr 1fr;
    padding:0 4px 12px;
    border-bottom:1px solid var(--border-soft);
    font-size:11.5px;font-weight:700;letter-spacing:.04em;
    color:var(--text-faint);
    text-transform:uppercase;
  }
  
  .booking-row{
    display:grid;
    grid-template-columns:0.5fr 1.5fr 1.5fr 1.2fr 1fr 1fr;
    padding:12px 4px;
    border-bottom:1px solid #f3f4f7;
    font-size:13px;
    align-items:center;
  }
  .booking-row:last-child{border-bottom:none;}
  .booking-row span{color:var(--text-dark);}

  .btn-action{
    display:inline-flex;align-items:center;justify-content:center;
    width:32px;height:32px;border-radius:8px;border:none;
    cursor:pointer;text-decoration:none;font-size:13px;
    margin-right:4px;transition:all 0.2s ease;
  }
  .btn-edit{background:rgba(59,130,246,0.1);color:#3B82F6;}
  .btn-edit:hover{background:#3B82F6;color:#fff;}
  .btn-view{background:rgba(16,185,129,0.1);color:#10B981;}
  .btn-view:hover{background:#10B981;color:#fff;}

  .status-badge{
    display:inline-block;
    padding:3px 12px;
    border-radius:20px;
    font-size:11px;
    font-weight:600;
  }
  .status-menunggu{background:#fef3c7;color:#92400e;}
  .status-dikerjakan{background:#dbeafe;color:#1e40af;}
  .status-selesai{background:#d1fae5;color:#065f46;}
  .status-dibatalkan{background:#fee2e2;color:#991b1b;}

  .empty-state{
    padding:54px 10px 46px;
    text-align:center;
  }
  .empty-state i.big{font-size:34px;color:#cfd3da;margin-bottom:14px;display:block;}
  .empty-state .headline{margin:0;font-size:14px;font-weight:700;color:#5d6472;}
  .empty-state .hint{margin:6px 0 0;font-size:12.5px;color:var(--text-faint);}
  .empty-state .hint strong{color:var(--gold-dark);font-weight:700;}

  @media (max-width:1100px){
    .stats-grid{grid-template-columns:repeat(2,1fr);}
    .quick-actions{flex-wrap:wrap;}
    .qa-btn{flex:1 1 45%;}
  }
  @media (max-width:760px){
    .stats-grid{grid-template-columns:1fr 1fr;gap:12px;}
    .table-head{display:none;}
    .booking-row{grid-template-columns:1fr;gap:4px;padding:16px 4px;}
    .quick-actions{flex-direction:column;}
    .qa-btn{flex:1;}
  }
</style>

<!-- Welcome banner -->
<section class="banner">
  <div class="banner-top">
    <p class="greeting">Selamat datang kembali, {{ Auth::user()->name ?? 'Admin' }} 👋</p>
    <p class="sub">Berikut ringkasan aktivitas bengkel hari ini</p>
  </div>
  <div class="pills">
    <span class="pill"><i class="fa-solid fa-calendar-days"></i> {{ date('d F Y') }}</span>
    <span class="pill"><i class="fa-solid fa-clock"></i> <span id="clockDisplay">{{ date('H:i') }}</span></span>
    <span class="pill status"><i class="fa-solid fa-circle-check"></i> Bengkel Aktif</span>
  </div>
</section>

<!-- Stats -->
<section class="stats-grid">
  <div class="stat-card">
    <div class="stat-info">
      <p class="label">Total Kendaraan</p>
      <p class="value">{{ $totalKendaraan ?? 0 }}</p>
      <p class="desc">{{ $totalKendaraan > 0 ? $totalKendaraan . ' kendaraan' : 'Belum ada kendaraan' }}</p>
    </div>
    <div class="stat-icon icon-teal"><i class="fa-solid fa-car"></i></div>
  </div>

  <div class="stat-card">
    <div class="stat-info">
      <p class="label">Total Booking</p>
      <p class="value">{{ $totalBooking ?? 0 }}</p>
      <p class="desc">{{ $totalBooking > 0 ? $totalBooking . ' booking' : 'Belum ada booking' }}</p>
    </div>
    <div class="stat-icon icon-yellow"><i class="fa-solid fa-calendar-check"></i></div>
  </div>

  <div class="stat-card">
    <div class="stat-info">
      <p class="label">Menunggu Konfirmasi</p>
      <p class="value">{{ $totalPending ?? 0 }}</p>
      <p class="desc">{{ $totalPending > 0 ? $totalPending . ' antrian' : 'Tidak ada antrian' }}</p>
    </div>
    <div class="stat-icon icon-pink"><i class="fa-regular fa-clock"></i></div>
  </div>

  <div class="stat-card">
    <div class="stat-info">
      <p class="label">Total Customer</p>
      <p class="value">{{ $totalCustomer ?? 0 }}</p>
      <p class="desc positive"><i class="fa-solid fa-arrow-up"></i> 12% dari bulan lalu</p>
    </div>
    <div class="stat-icon icon-dark"><i class="fa-solid fa-users"></i></div>
  </div>
</section>

<!-- Quick actions -->
<section class="card">
  <div class="card-header">
    <div class="title"><i class="fa-solid fa-bolt"></i> Aksi Cepat</div>
  </div>
  <div class="quick-actions">
    <a href="{{ route('admin.kendaraan.create') }}" class="qa-btn dark"><i class="fa-solid fa-plus"></i> Tambah Kendaraan</a>
    <a href="{{ route('admin.customers.create') }}" class="qa-btn teal"><i class="fa-solid fa-user-plus"></i> Tambah Customer</a>
    <a href="{{ route('admin.booking.create') }}" class="qa-btn gold"><i class="fa-solid fa-calendar-plus"></i> Booking Baru</a>
  </div>
</section>

<!-- ===== RIWAYAT BOOKING ===== -->
<section class="card">
  <div class="card-header">
    <div class="title"><i class="fa-solid fa-clock-rotate-left" style="color:#a9842f;margin-right:8px;"></i> Riwayat Booking</div>
    <a href="{{ route('admin.booking.index') }}" class="link">Lihat semua <i class="fa-solid fa-arrow-right"></i></a>
  </div>

  <div class="table-head">
    <span>No</span>
    <span>Customer</span>
    <span>Kendaraan</span>
    <span>Tanggal</span>
    <span>Status</span>
    <span>Aksi</span>
  </div>

  @forelse($riwayatBookings ?? [] as $booking)
  <div class="booking-row">
    <span>{{ $loop->iteration }}</span>
    <span>{{ $booking->user->name ?? '-' }}</span>
    <span>{{ $booking->kendaraan->plat_nomor ?? '-' }}</span>
    <span>{{ \Carbon\Carbon::parse($booking->tanggal_mulai)->format('d/m/Y') }}</span>
    <span>
      <span class="status-badge status-{{ $booking->status }}">
        {{ ucfirst($booking->status) }}
      </span>
    </span>
    <span>
      <a href="{{ route('admin.booking.edit', $booking->id) }}" class="btn-action btn-edit">
        <i class="fa-solid fa-pen"></i>
      </a>
      <a href="{{ route('admin.booking.show', $booking->id) }}" class="btn-action btn-view">
        <i class="fa-solid fa-eye"></i>
      </a>
    </span>
  </div>
  @empty
  <div class="empty-state">
    <i class="fa-solid fa-calendar-xmark big"></i>
    <p class="headline">Belum ada booking</p>
    <p class="hint">Klik <strong>Booking Baru</strong> untuk menambahkan</p>
  </div>
  @endforelse
</section>

<script>
  function updateClock() {
    const now = new Date();
    const time = now.toLocaleTimeString('id-ID', {
      hour: '2-digit',
      minute: '2-digit',
      hour12: false
    });
    const clockDisplay = document.getElementById('clockDisplay');
    if (clockDisplay) {
      clockDisplay.textContent = time;
    }
  }
  updateClock();
  setInterval(updateClock, 1000);
</script>
@endsection