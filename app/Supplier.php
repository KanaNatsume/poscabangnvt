<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';
    protected $fillable = [
        'nama',
        'no_hp',
        'email',
        'no_rekening',
        'rekening_atas_nama',
        'bank',
        'kode_pos',
        'alamat',
        'deskripsi',
    ];

    public function detailPembelian()
    {
        return $this->hasMany(DetailPembelian::class);
    }
}
