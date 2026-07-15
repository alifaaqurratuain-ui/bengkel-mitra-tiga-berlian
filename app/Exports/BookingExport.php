<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookingExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Booking::with(['user', 'kendaraan'])
                    ->get()
                    ->map(function ($booking) {
                        return [
                            'id' => $booking->id,
                            'customer' => $booking->user->name ?? '-',
                            'kendaraan' => $booking->kendaraan->merk ?? '-',
                            'plat_nomor' => $booking->kendaraan->plat_nomor ?? '-',
                            'tanggal_mulai' => $booking->tanggal_mulai,
                            'tanggal_selesai' => $booking->tanggal_selesai,
                            'status' => $booking->status,
                            'total_harga' => $booking->total_harga ?? 0,
                            'created_at' => $booking->created_at,
                        ];
                    });
    }

    public function headings(): array
    {
        return ['ID', 'Customer', 'Kendaraan', 'Plat Nomor', 'Tanggal Mulai', 'Tanggal Selesai', 'Status', 'Total Harga', 'Tanggal Booking'];
    }
}