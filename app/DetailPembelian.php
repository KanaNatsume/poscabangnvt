<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    protected $table = 'detail_pembelian';
    protected $fillable = [
        'supplier_id',
        'no_pembelian',
        'total_pembayaran',
        'pembayaran',
        'kembalian',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
