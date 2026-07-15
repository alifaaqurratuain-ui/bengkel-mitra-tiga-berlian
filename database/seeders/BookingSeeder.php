<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
    public function run()
    {
        Booking::create([
            'customer_name' => 'hani',
            'vehicle' => 'Avanza',
            'date' => '2026-06-26',
            'status' => 'Selesai'
        ]);

        Booking::create([
            'customer_name' => 'naufal',
            'vehicle' => 'Xenia',
            'date' => '2026-06-26',
            'status' => 'menunggu'
        ]);

        Booking::create([
            'customer_name' => 'hani',
            'vehicle' => 'Vario',
            'date' => '2026-06-25',
            'status' => 'selesai'
        ]);
    }
}