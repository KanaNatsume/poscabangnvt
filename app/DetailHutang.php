<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailHutang extends Model
{
    protected $table = 'detail_hutang';
    protected $fillable = [
        'no_invoice',
        'pembayaran',
    ];
}
