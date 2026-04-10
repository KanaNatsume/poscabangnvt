<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $fillable = [
        'nama',
        'no_hp',
        'email',
        'alamat',
    ];

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class);
    }

    public function hutang()
    {
        return $this->hasMany(Hutang::class);
    }

    public function returBarang()
    {
        return $this->hasMany(ReturBarang::class);
    }

    public function transfer()
    {
        return $this->hasMany(Transfer::class);
    }
}
