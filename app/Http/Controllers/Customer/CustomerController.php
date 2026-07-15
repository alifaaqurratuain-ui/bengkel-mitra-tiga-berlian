<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        
        // Total Booking customer ini
        $totalBooking = Booking::where('user_id', $user->id)->count();
        
        // Booking yang sedang berlangsung (menunggu atau dikerjakan)
        $activeBookings = Booking::where('user_id', $user->id)
                                ->whereIn('status', ['menunggu', 'dikerjakan'])
                                ->count();
        
        // Booking selesai
        $completedBookings = Booking::where('user_id', $user->id)
                                    ->where('status', 'selesai')
                                    ->count();
        
        // Riwayat Booking terbaru
        $recentBookings = Booking::with(['kendaraan'])
                                ->where('user_id', $user->id)
                                ->orderBy('created_at', 'desc')
                                ->limit(5)
                                ->get();
        
        return view('customer.dashboard', compact(
            'totalBooking',
            'activeBookings',
            'completedBookings',
            'recentBookings'
        ));
    }
    
    public function profile()
    {
        return view('customer.profile');
    }
    
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
        ]);
        
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        
        return redirect()->route('customer.profile')
            ->with('success', 'Profile berhasil diupdate!');
    }
}