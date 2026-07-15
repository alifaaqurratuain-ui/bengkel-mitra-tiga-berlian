<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'kendaraan_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'keperluan',
        'status',
        'total_harga',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
}