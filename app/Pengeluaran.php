<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluaran';
    protected $fillable = [
        'no_pengeluaran',
        'jenis',
        'tanggal',
        'nama',
        'jumlah',
        'keterangan',
        'kategori_pengeluaran',
    ];
}
