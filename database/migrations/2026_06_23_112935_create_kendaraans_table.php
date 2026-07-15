<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->id();
            $table->string('plat_nomor')->unique();
            $table->string('merk');
            $table->string('model');
            $table->string('warna');
            $table->integer('tahun');
            $table->string('tipe'); // mobil, motor, truk
            $table->string('status')->default('tersedia'); // tersedia, disewa, service
            $table->decimal('harga_sewa_per_hari', 10, 2);
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kendaraans');
    }
};