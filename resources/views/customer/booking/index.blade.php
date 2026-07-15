@extends('layouts.customer')

@section('title', 'Booking Saya - Mitra Tiga Berlian')
@section('page-title', 'Booking Saya')
@section('page-subtitle', 'Daftar booking kendaraan anda')

@section('content')
<style>
    .card {
        background: #fff;
        border-radius: 16px;
        padding: 22px 24px;
        box-shadow: 0 1px 2px rgba(16,24,40,.04), 0 4px 10px rgba(16,24,40,.05);
    }
    .table-wrap {
        overflow-x: auto;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    th {
        text-align: left;
        padding: 10px 12px;
        color: #9aa1ae;
        font-weight: 700;
        font-size: 11.5px;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        border-bottom: 1px solid #eceef2;
    }
    td {
        padding: 10px 12px;
        border-bottom: 1px solid #f3f4f7;
        color: #16213a;
    }
    tr:hover td {
        background: #f8f9fb;
    }
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
    .btn-view {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        background: rgba(16,185,129,0.1);
        color: #10B981;
        transition: all 0.2s ease;
    }
    .btn-view:hover {
        background: #10B981;
        color: #fff;
    }
    .empty-state {
        text-align: center;
        padding: 40px 20px;
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
    .btn-print {
    background: rgba(139, 92, 246, 0.1);
    color: #8B5CF6;
    border: 1px solid rgba(139, 92, 246, 0.2);
}
.btn-print:hover {
    background: #8B5CF6;
    color: #fff;
}
</style>

<div class="card">
    <div class="card-header">
        <div class="title"><i class="fa-solid fa-calendar-check" style="color:#a9842f;margin-right:8px;"></i> Booking Saya</div>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kendaraan</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Status</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $booking->kendaraan->plat_nomor ?? '-' }} - {{ $booking->kendaraan->merk ?? '' }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->tanggal_mulai)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->tanggal_selesai)->format('d/m/Y') }}</td>
                    <td>
                        <span class="status-badge status-{{ $booking->status }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                    <td style="text-align:center;">
                        <a href="{{ route('customer.booking.show', $booking->id) }}" class="btn-view">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="{{ route('customer.booking.print', $booking->id) }}" 
   class="btn btn-print btn-sm" 
   target="_blank">
    <i class="fa-solid fa-print"></i> Cetak
</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <i class="fa-solid fa-calendar-xmark"></i>
                            <p class="headline">Belum ada booking</p>
                            <p class="hint">Silakan booking kendaraan melalui admin</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection