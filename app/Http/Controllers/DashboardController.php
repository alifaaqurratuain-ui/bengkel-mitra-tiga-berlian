<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Data statistik
        $totalKendaraan = 2;
        $totalBooking = Booking::count();
        $menungguKonfirmasi = Booking::where('status', 'Menunggu Konfirmasi')->count();
        $totalCustomer = Booking::distinct('customer_name')->count();

        // Riwayat booking terbaru
        $riwayatBooking = Booking::orderBy('date', 'desc')
                                 ->orderBy('id', 'desc')
                                 ->get();

        return view('dashboard', compact(
            'totalKendaraan',
            'totalBooking',
            'menungguKonfirmasi',
            'totalCustomer',
            'riwayatBooking'
        ));
    }
}