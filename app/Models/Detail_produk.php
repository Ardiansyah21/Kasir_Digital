<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_produk extends Model
{

  
    
     public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
    public function penjualan()
    {
        return $this->belongsTo(Penjual::class);
    }

    
    use HasFactory;
    protected $fillable = [
        'penjual_id',
        'penjualan_id',
        'produk_id',
        'jumlah_produk',
        'subtotal',

    ];
}