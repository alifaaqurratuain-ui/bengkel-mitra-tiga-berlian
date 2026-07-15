<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class CustomerBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['kendaraan'])
                        ->where('user_id', auth()->id())
                        ->orderBy('created_at', 'desc')
                        ->get();
        
        return view('customer.booking.index', compact('bookings'));
    }
    
    public function show($id)
    {
        $booking = Booking::with(['kendaraan'])
                        ->where('user_id', auth()->id())
                        ->findOrFail($id);
        
        return view('customer.booking.show', compact('booking'));
    }
    public function print($id)
{
    $booking = Booking::with(['user', 'kendaraan'])
                    ->where('user_id', auth()->id())
                    ->findOrFail($id);
    
    return view('customer.booking.print', compact('booking'));
}
}