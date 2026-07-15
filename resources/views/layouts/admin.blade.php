<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mitra Tiga Berlian - Admin')</title>
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
    gap: 2px;
    flex: 1;
    padding: 0;
    margin: 0;
    list-style: none;
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

.menu-item i {
    width: 18px;
    text-align: center;
    font-size: 15px;
    flex-shrink: 0;
}

.menu-item:hover {
    background: rgba(255, 255, 255, 0.05);
    color: #ffffff;
}

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
    background: rgba(255, 255, 255, 0.1);
    color: #cdd4e3;
    font-size: 10.5px;
    font-weight: 700;
    padding: 2px 10px;
    border-radius: 20px;
    flex-shrink: 0;
}

.menu-item.active .menu-badge {
    background: rgba(0, 0, 0, 0.06);
    color: #6b7280;
}
        .sidebar-footer {
            margin-top: auto;
            padding-top: 14px;
            border-top: 1px solid rgba(255,255,255,0.07);
        }
        .sidebar-footer .menu-item:hover { background: rgba(239,68,68,0.1); color: #f3a6a6; }
        
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
            font-size: 19px !important;
            font-weight: 700 !important;
            margin: 0 !important;
            color: #16213a !important;
        }
        .topbar-title p {
            font-size: 12.5px !important;
            color: #6b7280 !important;
            margin: 2px 0 0 !important;
            font-weight: 500 !important;
        }
        .topbar-right { display: flex; align-items: center; gap: 18px; }
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
        
        /* ===== RESPONSIVE ===== */
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
        </div>
    </div>

    <nav class="menu">
        <!-- 1. DASHBOARD -->
        <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-pie"></i> Dashboard
        </a>

        <!-- 2. CUSTOMER -->
        <a href="{{ route('admin.customers.index') }}" class="menu-item {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
            <i class="fa-solid fa-users"></i> Customer
            <span class="menu-badge">{{ \App\Models\User::where('role', 'customer')->count() }}</span>
        </a>

        <!-- 3. KENDARAAN -->
        <a href="{{ route('admin.kendaraan.index') }}" class="menu-item {{ request()->routeIs('admin.kendaraan.*') ? 'active' : '' }}">
            <i class="fa-solid fa-car"></i> Kendaraan
            <span class="menu-badge">{{ \App\Models\Kendaraan::count() }}</span>
        </a>

        <!-- 4. BOOKING -->
        <a href="{{ route('admin.booking.index') }}" class="menu-item {{ request()->routeIs('admin.booking.*') ? 'active' : '' }}">
            <i class="fa-solid fa-calendar-check"></i> Booking Saya
            <span class="menu-badge">{{ \App\Models\Booking::count() }}</span>
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
                    <p>@yield('page-subtitle', 'Kelola bengkel & rental dengan mudah')</p>
                </div>
            </div>
            <div class="topbar-right">
                <button class="icon-btn"><i class="fa-regular fa-bell"></i><span class="dot">3</span></button>
                <div class="user-block">
                    <div class="avatar">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</div>
                    <div class="user-info">
                        <p class="name">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="email">{{ Auth::user()->email ?? 'admin@bengkel.com' }}</p>
                    </div>
                </div>
            </div>
        </header>

        <div class="content">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>