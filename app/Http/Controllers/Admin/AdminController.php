<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kendaraan;
use App\Models\Booking;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Total Customer
        $totalCustomer = User::where('role', 'customer')->count();
        
        // Total Kendaraan
        $totalKendaraan = Kendaraan::count();
        
        // Total Booking
        $totalBooking = Booking::count();
        
        // Total Menunggu Konfirmasi (status menunggu)
        $totalPending = Booking::where('status', 'menunggu')->count();
        
        // Customer Terbaru (5 terakhir)
        $customers = User::where('role', 'customer')
                        ->orderBy('created_at', 'desc')
                        ->limit(5)
                        ->get();
        
        // Riwayat Booking Terbaru (5 terakhir)
        $riwayatBookings = Booking::with(['user', 'kendaraan'])
                                ->orderBy('created_at', 'desc')
                                ->limit(5)
                                ->get();
        
        return view('admin.dashboard', compact(
            'totalCustomer',
            'totalKendaraan',
            'totalBooking',
            'totalPending',
            'customers',
            'riwayatBookings'
        ));
    }
}