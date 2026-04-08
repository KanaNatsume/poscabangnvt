<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeluarController extends Controller
{
    public function index()
    {
        $title = 'Barang Keluar';
        $barang_keluar = DB::table('detail_penjualan')
            ->join('barang', 'detail_penjualan.kode_barang', 'barang.kode_barang')
            ->select('detail_penjualan.*', 'barang.nama_barang')
            ->orderBy('detail_penjualan.id', 'desc')
            ->get();
        return view('barang_keluar.index', compact('title', 'barang_keluar'));
    }
}
