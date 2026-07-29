<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailReturBarang extends Model
{
    protected $table = 'detail_retur_barang';
    protected $fillable = [
        'no_retur',
        'no_invoice',
        'kode_barang',
        'harga',
        'qty',
        'jenis',
        'keterangan',
    ];
}
