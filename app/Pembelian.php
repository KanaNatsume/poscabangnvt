<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelian';
    protected $fillable = [
        'no_pembelian',
        'kode_barang',
        'qty',
        'total_harga',
    ];
}
