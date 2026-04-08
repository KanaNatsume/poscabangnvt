<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hutang extends Model
{
    protected $table = 'hutang';
    protected $fillable = [
        'user_id',
        'pelanggan_id',
        'no_invoice',
        'sub_total',
        'pembayaran',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
