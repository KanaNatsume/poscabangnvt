<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPejualan extends Model
{
    protected $table = 'detail_penjualan';
    protected $fillable = [
        'no_invoice',
        'kode_barang',
        'harga',
        'qty',
    ];
}
