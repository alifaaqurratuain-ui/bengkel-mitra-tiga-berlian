<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminKendaraanController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\CustomerBookingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

// ================================================================
// ===== REDIRECT LOGIN JIKA SUDAH LOGIN =====
// ================================================================
Route::get('/login', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->role === 'customer') {
            return redirect()->route('customer.dashboard');
        }
    }
    return app()->make(\App\Http\Controllers\Auth\AuthenticatedSessionController::class)->create();
})->name('login');

// ================================================================
// ===== HOME =====
// ================================================================
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->role === 'customer') {
            return redirect()->route('customer.dashboard');
        }
    }
    return view('welcome');
});

// ================================================================
// ===== AUTH ROUTES (BREEZE) =====
// ================================================================
require __DIR__.'/auth.php';

// ================================================================
// ===== ROUTES ADMIN =====
// ================================================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // ===== CUSTOMERS =====
    Route::get('/customers', [AdminCustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [AdminCustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers', [AdminCustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/{id}/edit', [AdminCustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{id}', [AdminCustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{id}', [AdminCustomerController::class, 'destroy'])->name('customers.destroy');

    // Export Customer
    Route::get('/customers/export', [AdminCustomerController::class, 'export'])->name('customers.export');

    // ===== KENDARAAN =====
    Route::get('/kendaraan', [AdminKendaraanController::class, 'index'])->name('kendaraan.index');
    Route::get('/kendaraan/create', [AdminKendaraanController::class, 'create'])->name('kendaraan.create');
    Route::post('/kendaraan', [AdminKendaraanController::class, 'store'])->name('kendaraan.store');
    Route::get('/kendaraan/{id}/edit', [AdminKendaraanController::class, 'edit'])->name('kendaraan.edit');
    Route::put('/kendaraan/{id}', [AdminKendaraanController::class, 'update'])->name('kendaraan.update');
    Route::delete('/kendaraan/{id}', [AdminKendaraanController::class, 'destroy'])->name('kendaraan.destroy');


    // Export Kendaraan
    Route::get('/kendaraan/export', [AdminKendaraanController::class, 'export'])->name('kendaraan.export');

    // ===== BOOKING =====
    Route::get('/booking', [AdminBookingController::class, 'index'])->name('booking.index');
    Route::get('/booking/create', [AdminBookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [AdminBookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{id}/edit', [AdminBookingController::class, 'edit'])->name('booking.edit');
    Route::put('/booking/{id}', [AdminBookingController::class, 'update'])->name('booking.update');
    Route::delete('/booking/{id}', [AdminBookingController::class, 'destroy'])->name('booking.destroy');
    Route::get('/booking/{id}', [AdminBookingController::class, 'show'])->name('booking.show');

    // Update Status Booking
    Route::patch('/booking/{id}/status', [AdminBookingController::class, 'updateStatus'])->name('booking.updateStatus');

    // ===== EXPORT BOOKING (DI DALAM GROUP ADMIN) =====
    Route::get('/booking/export', [AdminBookingController::class, 'export'])->name('booking.export');
});

// ================================================================
// ===== ROUTES CUSTOMER =====
// ================================================================
Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');

    // Profile
    Route::get('/profile', [CustomerController::class, 'profile'])->name('profile');
    Route::put('/profile', [CustomerController::class, 'updateProfile'])->name('profile.update');

    // Booking Customer
    Route::get('/booking', [CustomerBookingController::class, 'index'])->name('booking.index');
    Route::get('/booking/{id}', [CustomerBookingController::class, 'show'])->name('booking.show');
    Route::get('/booking/{id}/print', [CustomerBookingController::class, 'print'])->name('booking.print');
});

// ================================================================
// ===== REDIRECT DASHBOARD =====
// ================================================================
Route::get('/export-booking-manual', function() {
    // Ambil data booking
    $bookings = \App\Models\Booking::with(['user', 'kendaraan'])->get();
    
    // Buat file CSV
    $filename = 'booking_' . date('Y-m-d') . '.csv';
    $handle = fopen('php://output', 'w');
    
    // Header CSV
    fputcsv($handle, ['ID', 'Customer', 'Kendaraan', 'Plat Nomor', 'Tanggal Mulai', 'Tanggal Selesai', 'Status', 'Total Harga', 'Tanggal Booking']);
    
    // Isi data
    foreach ($bookings as $booking) {
        fputcsv($handle, [
            $booking->id,
            $booking->user->name ?? '-',
            $booking->kendaraan->merk ?? '-',
            $booking->kendaraan->plat_nomor ?? '-',
            $booking->tanggal_mulai,
            $booking->tanggal_selesai,
            $booking->status,
            $booking->total_harga ?? 0,
            $booking->created_at,
        ]);
    }
    fclose($handle);
    
    // Download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    exit;
});

Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif (auth()->check() && auth()->user()->role === 'customer') {
        return redirect()->route('customer.dashboard');
    }
    return redirect('/login');
})->name('dashboard');

// ================================================================
// ===== REDIRECT HOME =====
// ================================================================
Route::get('/home', function () {
    if (auth()->check() && auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif (auth()->check() && auth()->user()->role === 'customer') {
        return redirect()->route('customer.dashboard');
    }
    return redirect('/login');
})->name('home');