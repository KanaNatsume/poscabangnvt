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
        'harga_custom',
        'profit_harga_custom',
        'harga_customb',
        'profit_harga_customb',
        'harga_customc',
        'profit_harga_customc',
        'harga_customd',
        'profit_harga_customd',
        'harga_custome',
        'profit_harga_custome',
        'harga_customf',
        'profit_harga_customf',
        'harga_customg',
        'profit_harga_customg',
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
