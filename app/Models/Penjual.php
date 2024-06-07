<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Detail_produk;


class Penjual extends Model
{


    use HasFactory;
    public function detailpenjualan()
    {
        return $this->belongsTo(Detail_produk::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
    
        protected $fillable = [
        'total_harga',
        'pelanggan_id',
        'date',
        'user_id',
        'return',
        'payment',
        'price_amount'


    ];
}