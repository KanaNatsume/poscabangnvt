<?php

namespace App\Http\Controllers;

use App\Barang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $barang_ready = DB::table('barang')->where('stok', '>', 0)->where('is_jasa', 0)->orderBy('stok', 'asc')->get();
        // dd($cek_stok_barang);

        $supplier = DB::table('supplier')->count();
        $kategori = DB::table('kategori')->count();
        $barang = DB::table('barang')->count();
        $pelanggan = DB::table('pelanggan')->count();
        $hutang = DB::table('hutang')->where('status', 0)->count();
        $pembelian = DB::table('pembelian')->whereDate('created_at', Carbon::today())->count();
        $penjualan = DB::table('penjualan')->whereDate('created_at', Carbon::today())->count();
        $retur = DB::table('retur_barang')->whereDate('created_at', Carbon::today())->count();
        $pengeluaran = DB::table('pengeluaran')->whereDate('created_at', Carbon::today())->count();
        $transfer = DB::table('transfer')->whereDate('created_at', Carbon::today())->count();
        return view('dashboard', compact('barang_ready', 'supplier', 'kategori', 'barang', 'pelanggan', 'hutang', 'pembelian', 'penjualan', 'retur', 'pengeluaran', 'transfer'));
    }

    public function chart()
    {
        $stok_barang = DB::table('stok_barang')->get();
        $labels = [];
        $data = [];

        foreach ($stok_barang as $item) {
            $labels[] = $item->kode_barang; // ['nama barang ke 1', 'nama barang ke 2', 'nama barang ke 3']
            $data[] = $item->qty;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }

    public function tes_autocomplete()
    {
        return view('tes_autocomplete');
    }
}
