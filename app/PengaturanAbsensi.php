<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengaturanAbsensi extends Model
{
    protected $fillable = [
        'latitude', 'longitude', 'radius'
    ];
}