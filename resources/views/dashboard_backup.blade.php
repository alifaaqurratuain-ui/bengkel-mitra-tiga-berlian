<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Bengkel</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background: #f4f6f9;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            font-size: 28px;
            color: #1a2332;
        }
        .subtitle {
            color: #6b7280;
            margin-bottom: 20px;
        }
        .header-info {
            background: #eef2ff;
            padding: 15px 20px;
            border-radius: 8px;
            margin: 20px 0;
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }
        .header-info span {
            font-weight: 600;
            color: #1a2332;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }
        .stat-card {
            background: #f9fafb;
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid #3b82f6;
        }
        .stat-card .number {
            font-size: 32px;
            font-weight: bold;
            color: #1a2332;
        }
        .stat-card .label {
            color: #6b7280;
            font-size: 14px;
        }
        .stat-card .detail {
            color: #9ca3af;
            font-size: 13px;
            margin-top: 5px;
        }
        .quick-actions {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin: 30px 0;
        }
        .quick-actions button {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }
        .quick-actions button:hover {
            background: #2563eb;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background: #f3f4f6;
            text-align: left;
            padding: 12px;
            font-weight: 600;
            color: #374151;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
        }
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
        }
        .status-selesai {
            background: #d1fae5;
            color: #065f46;
        }
        .status-proses {
            background: #fef3c7;
            color: #92400e;
        }
        .status-menunggu {
            background: #fee2e2;
            color: #991b1b;
        }
        .logout {
            margin-top: 30px;
            text-align: right;
        }
        .logout a {
            color: #ef4444;
            text-decoration: none;
            font-weight: 600;
        }
        .logout a:hover {
            text-decoration: underline;
        }
        .section-title {
            font-size: 20px;
            font-weight: 600;
            margin: 30px 0 15px 0;
            color: #1a2332;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dashboard</h1>
        <p class="subtitle">Kelola bengkel dengan mudah</p>

        <div class="header-info">
            <span>📅 26 June 2026</span>
            <span>🕐 09.16</span>
            <span>🟢 Bengkel Aktif</span>
        </div>

        <!-- Statistik -->
        <div class="stats">
            <div class="stat-card">
                <div class="number">{{ $totalKendaraan }}</div>
                <div class="label">Total Kendaraan</div>
                <div class="detail">{{ $totalKendaraan }} kendaraan</div>
            </div>
            <div class="stat-card">
                <div class="number">{{ $totalBooking }}</div>
                <div class="label">Total Booking</div>
                <div class="detail">{{ $totalBooking }} booking</div>
            </div>
            <div class="stat-card">
                <div class="number">{{ $menungguKonfirmasi }}</div>
                <div class="label">Menunggu Konfirmasi</div>
                <div class="detail">{{ $menungguKonfirmasi }} antrian</div>
            </div>
            <div class="stat-card">
                <div class="number">{{ $totalCustomer }}</div>
                <div class="label">Total Customer</div>
                <div class="detail">{{ $totalCustomer }} customer</div>
            </div>
        </div>

        <!-- Aksi Cepat -->
        <div class="quick-actions">
            <button>+ Tambah Kendaraan</button>
            <button>+ Tambah Customer</button>
            <button>+ Booking Baru</button>
        </div>

        <!-- Riwayat Aktivitas Booking -->
        <h2 class="section-title">Riwayat Aktivitas Booking</h2>
        <table>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>CUSTOMER</th>
                    <th>KENDARAAN</th>
                    <th>TANGGAL</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayatBooking as $index => $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $booking->customer_name }}</td>
                    <td>{{ $booking->vehicle }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->date)->format('d/m/Y') }}</td>
                    <td>
                        @php
                            $statusClass = '';
                            if($booking->status == 'Selesai') {
                                $statusClass = 'status-selesai';
                            } elseif($booking->status == 'Proses') {
                                $statusClass = 'status-proses';
                            } else {
                                $statusClass = 'status-menunggu';
                            }
                        @endphp
                        <span class="status-badge {{ $statusClass }}">
                            {{ $booking->status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 30px; color: #9ca3af;">
                        Belum ada riwayat booking
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="logout">
            <a href="#">Logout</a>
        </div>
    </div>
</body>
</html>