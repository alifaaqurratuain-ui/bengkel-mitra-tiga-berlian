<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mitra Tiga Berlian') }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * { font-family: 'Inter', sans-serif; }

        :root {
            --gold: #D4AF37;
            --gold-light: #F5E6B8;
            --gold-dark: #B8960C;
            --bg-body: #0d0d0d;
            --bg-sidebar: #1a1a1a;
            --border-gold: rgba(212, 175, 55, 0.2);
            --text-gold: #D4AF37;
            --text-white: #ffffff;
            --text-muted: #a0a0a0;
        }

        body {
            background: var(--bg-body);
            color: var(--text-white);
            min-height: 100vh;
            display: flex;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border-gold);
            padding: 20px 0;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            z-index: 1000;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .sidebar .brand {
            padding: 0 20px 20px 20px;
            border-bottom: 1px solid var(--border-gold);
            margin-bottom: 16px;
        }

        .sidebar .brand a {
            color: var(--gold);
            font-size: 20px;
            font-weight: 800;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar .brand a:hover {
            color: var(--gold-light);
        }

        .sidebar .menu-label {
            color: var(--text-muted);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 8px 24px;
            font-weight: 600;
        }

        .sidebar .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 24px;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: 0.3s;
            border-left: 3px solid transparent;
        }

        .sidebar .menu-item:hover {
            color: var(--gold);
            background: rgba(212, 175, 55, 0.05);
        }

        .sidebar .menu-item.active {
            color: var(--gold);
            background: rgba(212, 175, 55, 0.08);
            border-left-color: var(--gold);
        }

        .sidebar .menu-item i {
            font-size: 18px;
            width: 24px;
            text-align: center;
        }

        .sidebar .bottom {
            margin-top: auto;
            padding-top: 16px;
            border-top: 1px solid var(--border-gold);
        }

        .sidebar .bottom .user-info {
            padding: 10px 24px;
            color: var(--gold-light);
            font-size: 13px;
            font-weight: 500;
        }

        .sidebar .bottom .btn-logout {
            margin: 0 20px;
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            color: #1a1a1a;
            border: none;
            padding: 8px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: 0.3s;
            width: calc(100% - 40px);
        }

        .sidebar .bottom .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(212, 175, 55, 0.3);
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-left: 250px;
            padding: 24px 32px;
            flex: 1;
            min-height: 100vh;
        }

        /* ===== MOBILE ===== */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
                transform: translateX(-100%);
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
                padding: 16px;
            }
            .hamburger {
                display: flex !important;
            }
        }

        .hamburger {
            display: none;
            position: fixed;
            top: 16px;
            left: 16px;
            z-index: 1001;
            background: var(--bg-sidebar);
            border: 1px solid var(--border-gold);
            color: var(--gold);
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 24px;
        }

        /* ===== OVERLAY ===== */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
        .sidebar-overlay.active {
            display: block;
        }

    </style>
</head>
<body>

    <!-- HAMBURGER (Mobile) -->
    <button class="hamburger" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>

    <!-- OVERLAY -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- ===== SIDEBAR ===== -->
    <div class="sidebar" id="sidebar">
        <div class="brand">
            <a href="{{ route('dashboard') }}">
                <i class="bi bi-car-front"></i> Mitra Tiga
            </a>
        </div>

        <div class="menu-label">Menu</div>

        @auth
            @if(auth()->user()->role == 'admin')
                <a class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a class="menu-item {{ request()->routeIs('admin.customers') ? 'active' : '' }}" href="{{ route('admin.customers') }}">
                    <i class="bi bi-people"></i> Customer
                </a>
                <a class="menu-item {{ request()->routeIs('admin.kendaraans') ? 'active' : '' }}" href="{{ route('admin.kendaraans') }}">
                    <i class="bi bi-car-front"></i> Kendaraan
                </a>
                <a class="menu-item {{ request()->routeIs('admin.bookings') ? 'active' : '' }}" href="{{ route('admin.bookings') }}">
                    <i class="bi bi-calendar-check"></i> Booking
                </a>
            @else
                <a class="menu-item {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}" href="{{ route('customer.dashboard') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a class="menu-item {{ request()->routeIs('customer.kendaraans') ? 'active' : '' }}" href="{{ route('customer.kendaraans') }}">
                    <i class="bi bi-car-front"></i> Kendaraan Saya
                </a>
                <a class="menu-item {{ request()->routeIs('customer.bookings') ? 'active' : '' }}" href="{{ route('customer.bookings') }}">
                    <i class="bi bi-clock-history"></i> Riwayat Booking
                </a>
            @endif
        @endauth

        <div class="bottom">
            @auth
                <div class="user-info">
                    <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="menu-item">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </a>
                <a href="{{ route('register') }}" class="menu-item">
                    <i class="bi bi-person-plus"></i> Register
                </a>
            @endauth
        </div>
    </div>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="main-content">
        @yield('content')
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('active');
        }
    </script>
</body>
</html>