<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Kendaraan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\BookingExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminBookingController extends Controller
{
   public function index(Request $request)
{
    $search = $request->get('search');
    
    $bookings = Booking::with(['user', 'kendaraan'])
                    ->when($search, function ($query, $search) {
                        return $query->whereHas('user', function ($q) use ($search) {
                            $q->where('name', 'LIKE', "%{$search}%")
                              ->orWhere('email', 'LIKE', "%{$search}%");
                        })->orWhereHas('kendaraan', function ($q) use ($search) {
                            $q->where('plat_nomor', 'LIKE', "%{$search}%")
                              ->orWhere('merk', 'LIKE', "%{$search}%");
                        });
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();
    
    return view('admin.booking.index', compact('bookings', 'search'));
}

    public function create()
    {
        $customers = User::where('role', 'customer')->get();
        $kendaraans = Kendaraan::all();
        return view('admin.booking.create', compact('customers', 'kendaraans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ]);

        Booking::create([
            'user_id' => $request->user_id,
            'kendaraan_id' => $request->kendaraan_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'menunggu',
            'total_harga' => 0,
        ]);

        return redirect()->route('admin.booking.index')
            ->with('success', 'Booking berhasil ditambahkan!');
    }

    public function show($id)
    {
        $booking = Booking::with(['user', 'kendaraan'])->findOrFail($id);
        return view('admin.booking.show', compact('booking'));
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $customers = User::where('role', 'customer')->get();
        $kendaraans = Kendaraan::all();
        return view('admin.booking.edit', compact('booking', 'customers', 'kendaraans'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'status' => 'required|in:menunggu,dikerjakan,selesai,dibatalkan',
        ]);

        $booking->update($request->all());

        return redirect()->route('admin.booking.index')
            ->with('success', 'Booking berhasil diupdate!');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.booking.index')
            ->with('success', 'Booking berhasil dihapus!');
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        return redirect()->back()
            ->with('success', 'Status booking berhasil diupdate!');
    }
    public function export()
{
    return Excel::download(new BookingExport, 'booking_' . date('Y-m-d') . '.xlsx');
}
}