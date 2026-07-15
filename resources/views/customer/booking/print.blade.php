<!DOCTYPE html>
<html>
<head>
    <title>Nota Booking - Mitra Tiga Berlian</title>
    <style>
        body { font-family: 'Courier New', monospace; padding: 40px; }
        .header { text-align: center; border-bottom: 2px dashed #cda04a; padding-bottom: 20px; }
        .header h1 { color: #cda04a; font-size: 28px; }
        .detail { margin: 30px 0; }
        .detail table { width: 100%; border-collapse: collapse; }
        .detail td { padding: 8px 0; border-bottom: 1px solid #e5e5e5; }
        .label { font-weight: bold; width: 30%; }
        .footer { text-align: center; margin-top: 40px; border-top: 2px dashed #cda04a; padding-top: 20px; }
        .status { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; }
        .status-menunggu { background: #fef3c7; color: #92400e; }
        .status-dikerjakan { background: #dbeafe; color: #1e40af; }
        .status-selesai { background: #d1fae5; color: #065f46; }
        .status-dibatalkan { background: #fee2e2; color: #991b1b; }
        @media print {
            body { padding: 20px; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>

<div class="header">
    <h1>🚗 Mitra Tiga Berlian</h1>
    <p>Bengkel &amp; Rental</p>
    <p><strong>NOTA BOOKING</strong></p>
    <p>Kode Booking: #{{ $booking->id }}</p>
</div>

<div class="detail">
    <table>
        <tr>
            <td class="label">Customer</td>
            <td>: {{ $booking->user->name }}</td>
        </tr>
        <tr>
            <td class="label">Kendaraan</td>
            <td>: {{ $booking->kendaraan->merk }} {{ $booking->kendaraan->model }}</td>
        </tr>
        <tr>
            <td class="label">Plat Nomor</td>
            <td>: {{ $booking->kendaraan->plat_nomor }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Mulai</td>
            <td>: {{ \Carbon\Carbon::parse($booking->tanggal_mulai)->format('d F Y') }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Selesai</td>
            <td>: {{ \Carbon\Carbon::parse($booking->tanggal_selesai)->format('d F Y') }}</td>
        </tr>
        <tr>
            <td class="label">Status</td>
            <td>: 
                <span class="status status-{{ $booking->status }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </td>
        </tr>
        <tr>
            <td class="label">Total Harga</td>
            <td>: Rp {{ number_format($booking->total_harga ?? 0, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Booking</td>
            <td>: {{ \Carbon\Carbon::parse($booking->created_at)->format('d F Y H:i') }}</td>
        </tr>
    </table>
</div>

<div class="footer">
    <p>Terima kasih atas kepercayaan Anda</p>
    <p><strong>Mitra Tiga Berlian</strong> - Bengkel &amp; Rental</p>
    <p style="font-size: 12px; color: #999; margin-top: 20px;">
        Dicetak pada: {{ now()->format('d F Y H:i') }}
    </p>
</div>

<script>
    window.print();
</script>

</body>
</html>