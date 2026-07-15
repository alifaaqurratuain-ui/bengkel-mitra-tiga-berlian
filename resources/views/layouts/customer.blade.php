<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mitra Tiga Berlian - Customer')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #f3f4f7;
            color: #16213a;
        }
        .app { display: flex; min-height: 100vh; }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 240px;
            background: linear-gradient(180deg, #121a2c, #0f1726);
            color: #cdd4e3;
            padding: 24px 16px;
            height: 100vh;
            position: sticky;
            top: 0;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }
        .brand {
            display: flex;
            gap: 10px;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
            margin-bottom: 20px;
        }
        .brand-icon {
            width: 40px; height: 40px;
            background: #0c1422;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .brand-icon i { color: #fff; font-size: 16px; }
        .brand-text h1 { font-size: 14px; font-weight: 700; color: #fff; }
        .brand-text p { font-size: 10px; color: #7e8aa3; }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex: 1;
        }
        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 10px;
            color: #9aa6bf;
            font-size: 13.5px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            position: relative;
        }
        .menu-item i { width: 18px; text-align: center; font-size: 15px; }
        .menu-item:hover { background: rgba(255,255,255,0.05); color: #fff; }
        .menu-item.active {
            background: #f7f9fc;
            color: #16213a;
        }
        .menu-item.active::before {
            content: "";
            position: absolute;
            left: -16px;
            top: 6px;
            bottom: 6px;
            width: 4px;
            border-radius: 0 4px 4px 0;
            background: #cda04a;
        }
        .menu-badge {
            margin-left: auto;
            background: rgba(255,255,255,0.1);
            color: #cdd4e3;
            font-size: 10.5px;
            font-weight: 700;
            padding: 2px 10px;
            border-radius: 20px;
        }
        .menu-item.active .menu-badge {
            background: rgba(0,0,0,0.06);
            color: #6b7280;
        }
        .sidebar-footer {
            margin-top: auto;
            padding-top: 14px;
            border-top: 1px solid rgba(255,255,255,0.07);
        }
        .sidebar-footer .menu-item:hover {
            background: rgba(239,68,68,0.1);
            color: #f3a6a6;
        }

        /* ===== MAIN ===== */
        .main { flex: 1; min-width: 0; }
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 32px;
            background: #eef0f4;
            border-bottom: 1px solid #e2e5eb;
            position: sticky;
            top: 0;
            z-index: 5;
        }
        .topbar-left { display: flex; align-items: center; gap: 16px; }
        .hamburger {
            background: none; border: none;
            width: 34px; height: 34px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #16213a;
            font-size: 16px;
            cursor: pointer;
        }
        .hamburger:hover { background: rgba(0,0,0,0.05); }
        .topbar-title h1 {
            font-size: 19px;
            font-weight: 700;
            margin: 0;
            color: #16213a;
        }
        .topbar-title p {
            font-size: 12.5px;
            color: #6b7280;
            margin: 2px 0 0;
            font-weight: 500;
        }
        .topbar-right { display: flex; align-items: center; gap: 18px; }
        
        /* ===== JAM ===== */
        .clock-display {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #6b7280;
            font-size: 14px;
            font-weight: 500;
        }
        .clock-display i {
            color: #cda04a;
        }
        
        .icon-btn {
            position: relative;
            width: 38px; height: 38px;
            border-radius: 50%;
            background: #fff;
            border: 1px solid #e6e8ed;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6b7280;
            cursor: pointer;
        }
        .icon-btn .dot {
            position: absolute;
            top: -3px; right: -3px;
            background: #e34850;
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            width: 17px; height: 17px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #eef0f4;
        }
        .user-block { display: flex; align-items: center; gap: 10px; }
        .avatar {
            width: 38px; height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #e9b65c, #c98f2c);
            color: #fff;
            font-weight: 700;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .user-info p.name {
            margin: 0;
            font-size: 13.5px;
            font-weight: 700;
            color: #16213a;
        }
        .user-info p.email {
            margin: 1px 0 0;
            font-size: 11.5px;
            color: #9aa1ae;
        }
        .content { padding: 24px 32px 40px; }

        /* ================================================================ */
        /* ===== ANIMASI ===== */
        /* ================================================================ */
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        @keyframes glow {
            0%, 100% {
                box-shadow: 0 0 5px rgba(205, 160, 74, 0.2);
            }
            50% {
                box-shadow: 0 0 20px rgba(205, 160, 74, 0.4);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-5px);
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -200% center;
            }
            100% {
                background-position: 200% center;
            }
        }

        @keyframes dotPulse {
            0%, 100% {
                opacity: 1;
                transform: scale(1);
            }
            50% {
                opacity: 0.5;
                transform: scale(0.8);
            }
        }

        /* ================================================================ */
        /* ===== TERAPKAN ANIMASI ===== */
        /* ================================================================ */
        
        /* Stat Card - Slide Up */
        .stat-card {
            animation: slideUp 0.6s ease-out forwards;
            opacity: 0;
        }
        .stat-card:nth-child(1) { animation-delay: 0.05s; }
        .stat-card:nth-child(2) { animation-delay: 0.1s; }
        .stat-card:nth-child(3) { animation-delay: 0.15s; }

        /* Stat Card - Hover Effect */
        .stat-card {
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        /* Stat Card - Pulse on Hover */
        .stat-card .value {
            transition: all 0.3s ease;
        }
        .stat-card:hover .value {
            animation: pulse 0.5s ease-in-out;
        }

        /* Banner Welcome - Slide Up */
        .banner-welcome {
            animation: slideUp 0.5s ease-out forwards;
            opacity: 0;
            animation-delay: 0.1s;
        }

        /* Card - Slide Up */
        .card {
            animation: slideUp 0.6s ease-out forwards;
            opacity: 0;
            animation-delay: 0.2s;
        }

        /* Dot Pulse untuk status aktif */
        .dot-pulse {
            display: inline-block;
            width: 8px;
            height: 8px;
            background: #7be3a8;
            border-radius: 50%;
            animation: dotPulse 1.5s ease-in-out infinite;
        }

        /* Shimmer untuk tombol gold */
        .btn-gold {
            background: linear-gradient(135deg, #d3b15c, #b08c3c);
            background-size: 200% auto;
            animation: shimmer 3s ease-in-out infinite;
            transition: all 0.3s ease;
        }
        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(205,160,74,0.3);
        }

        /* Float animation untuk icon */
        .float-icon {
            animation: float 3s ease-in-out infinite;
        }

        /* Glow effect untuk border */
        .glow-border {
            transition: all 0.3s ease;
        }
        .glow-border:hover {
            animation: glow 1.5s ease-in-out infinite;
        }

        @media (max-width: 760px) {
            .sidebar {
                position: fixed;
                left: 0; top: 0;
                z-index: 50;
                transform: translateX(-100%);
                transition: transform 0.2s;
            }
            .sidebar.open { transform: translateX(0); }
            .content { padding: 18px 16px 32px; }
            .topbar { padding: 14px 16px; }
        }
    </style>
</head>
<body>
<div class="app">

    <!-- ===== SIDEBAR ===== -->
    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <div class="brand-icon"><i class="fa-solid fa-car-side"></i></div>
            <div class="brand-text">
                <h1>Mitra Tiga Berlian</h1>
                <p>Bengkel &amp; Rental</p>
            </div>
        </div>

        <nav class="menu">
            <a href="{{ route('customer.dashboard') }}" class="menu-item {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-pie"></i> Dashboard
            </a>
            <a href="{{ route('customer.booking.index') }}" class="menu-item {{ request()->routeIs('customer.booking.*') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar-check"></i> Booking Saya
                <span class="menu-badge">{{ \App\Models\Booking::where('user_id', auth()->id())->count() }}</span>
            </a>
            <a href="{{ route('customer.profile') }}" class="menu-item {{ request()->routeIs('customer.profile') ? 'active' : '' }}">
                <i class="fa-solid fa-user"></i> Profile
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="#" class="menu-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </aside>

    <!-- ===== MAIN ===== -->
    <div class="main">
        <header class="topbar">
            <div class="topbar-left">
                <button class="hamburger" onclick="document.getElementById('sidebar').classList.toggle('open')">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="topbar-title">
                    <h1>@yield('page-title', 'Dashboard')</h1>
                    <p>@yield('page-subtitle', 'Kelola booking & rental anda')</p>
                </div>
            </div>
            <div class="topbar-right">
                <!-- JAM REAL-TIME -->
                <div class="clock-display">
                    <i class="fa-regular fa-clock"></i>
                    <span id="liveClock">{{ date('H:i:s') }}</span>
                </div>
                
                <button class="icon-btn"><i class="fa-regular fa-bell"></i><span class="dot">3</span></button>
                <div class="user-block">
                    <div class="avatar">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</div>
                    <div class="user-info">
                        <p class="name">{{ Auth::user()->name ?? 'Customer' }}</p>
                        <p class="email">{{ Auth::user()->email ?? 'customer@email.com' }}</p>
                    </div>
                </div>
            </div>
        </header>

        <div class="content">
            @yield('content')
        </div>
    </div>
</div>

<script>
    // ===== JAM REAL-TIME =====
    function updateClock() {
        const now = new Date();
        const time = now.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false
        });
        const clockElement = document.getElementById('liveClock');
        if (clockElement) {
            clockElement.textContent = time;
        }
        
        // Banner clock (tanpa detik)
        const bannerClock = document.getElementById('bannerClock');
        if (bannerClock) {
            const timeShort = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            });
            bannerClock.textContent = timeShort;
        }
    }
    updateClock();
    setInterval(updateClock, 1000);
</script>

</body>
</html>