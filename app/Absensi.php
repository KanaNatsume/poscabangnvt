<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $fillable = [
        'user_id', 'tanggal', 'jam_masuk', 'jam_pulang', 
        'status', 'keterangan', 'lat_long_masuk', 'lat_long_pulang'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}