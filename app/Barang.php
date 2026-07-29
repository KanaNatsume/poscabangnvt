<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $fillable = [
        'kategori_id',
        'kode_barang',
        'nama_barang',
        'gambar_barang',
        'harga_beli',
        'harga_ecer',
        'harga_grosir',
        'harga_agen',
        'profit_harga_ecer',
        'profit_harga_grosir',
        'profit_harga_agen',
        'deskripsi',
        'stok',
        'stok_minimal',
        'is_jasa',

    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
