<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE bookings MODIFY status ENUM('menunggu', 'dikerjakan', 'selesai', 'dibatalkan') DEFAULT 'menunggu'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE bookings MODIFY status ENUM('pending', 'disetujui', 'selesai', 'dibatalkan') DEFAULT 'pending'");
    }
};