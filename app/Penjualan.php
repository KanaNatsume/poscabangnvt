<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';
    protected $fillable = [
        'user_id',
        'pelanggan_id',
        'no_invoice',
        'total_pembayaran',
        'diskon',
        'sub_total',
        'pembayaran',
        'kembalian',
        'jenis',
        'jenis_bank',
        'bank_id',
        'bank_nama',
        'bank_rekening',
        'bank_atas_nama',
        'biaya_pengiriman',
        'bukti_transfer',
        'keterangan',
        'is_tukar_tambah',
        'nama_barang_tukar_tambah',
        'harga_tukar_tambah',
        'keterangan_tukar_tambah',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function detailPenjualan()
    {
        return $this->belongsTo(Detail_penjualan::class, 'no_invoice');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
