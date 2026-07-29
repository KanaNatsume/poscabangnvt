<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $table = 'transfer';
    protected $fillable = [
        'pelanggan_id',
        'nama',
        'total',
        'keterangan',
        'bukti',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
