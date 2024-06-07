<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    // Di dalam model Pelanggan


     public function penjual()
    {
        return $this->belongsTo(Penjual::class);
    }
    protected $fillable = [
        'nama_pelanggan',
        'alamat',
        'nomor_telepon',

    ];

    
}