<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kendaraans', function (Blueprint $table) {
            $table->dropColumn(['harga_sewa_per_hari', 'status']);
        });
    }

    public function down()
    {
        Schema::table('kendaraans', function (Blueprint $table) {
            $table->decimal('harga_sewa_per_hari', 15, 2)->nullable();
            $table->enum('status', ['tersedia', 'disewa', 'service'])->default('tersedia');
        });
    }
};