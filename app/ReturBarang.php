<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturBarang extends Model
{
    protected $table = 'retur_barang';
    protected $fillable = [
        'pelanggan_id',
        'no_retur',
        'total_pembayaran',
        'pembayaran',
        'kembalian',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
