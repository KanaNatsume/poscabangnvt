<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Detail_penjualan;
use App\Kategori;
use App\Pembelian;
use App\Penjualan;
use App\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class LaporanController extends Controller
{
    public function pembelian()
    {
        $title = 'Pembelian';
        $supplier = Supplier::all();
        return view('laporan.pembelian', compact('title', 'supplier'));
    }

    public function pembelian_semua()
    {
        $title = 'Pembelian';
        $pembelian = DB::table('pembelian')
            ->join('detail_pembelian', 'pembelian.no_pembelian', 'detail_pembelian.no_pembelian')
            ->join('supplier', 'detail_pembelian.supplier_id', 'supplier.id')
            ->join('barang', 'pembelian.kode_barang', 'barang.kode_barang')
            ->select('pembelian.*', 'detail_pembelian.supplier_id', 'supplier.nama as nama_supplier', 'barang.nama_barang')
            ->get();
        return view('laporan.pembelian_semua', compact('title', 'pembelian'));
    }

    public function pembelian_semua_download()
    {
        $title = 'Pembelian';
        $pembelian = DB::table('pembelian')
            ->join('detail_pembelian', 'pembelian.no_pembelian', 'detail_pembelian.no_pembelian')
            ->join('supplier', 'detail_pembelian.supplier_id', 'supplier.id')
            ->join('barang', 'pembelian.kode_barang', 'barang.kode_barang')
            ->select('pembelian.*', 'detail_pembelian.supplier_id', 'supplier.nama as nama_supplier', 'barang.nama_barang')
            ->get();
        $pdf = PDF::loadView('laporan.pembelian_semua_download', compact('title', 'pembelian'))->setPaper('a4', 'landscape');
        return $pdf->download('REKAPITULASI-TRANSAKSI-PEMBELIAN-BARANG.pdf');
    }

    public function pembelian_pertanggal(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal . " 00:00:00";
        $tanggal_akhir = $request->tanggal_akhir . " 23:59:59";

        $tanggal_awal1 = date('d-m-Y', strtotime($request->tanggal_awal));
        $tanggal_akhir1 = date('d-m-Y', strtotime($request->tanggal_akhir));
        $supplier = $request->supplier;
        $this->pembelian_pertanggal_download($request, $supplier);

        $title = 'Pembelian';
        $pembelian = DB::table('pembelian')
            ->join('detail_pembelian', 'pembelian.no_pembelian', 'detail_pembelian.no_pembelian')
            ->join('supplier', 'detail_pembelian.supplier_id', 'supplier.id')
            ->join('barang', 'pembelian.kode_barang', 'barang.kode_barang')
            ->select('pembelian.*', 'detail_pembelian.supplier_id', 'supplier.nama as nama_supplier', 'barang.nama_barang')
            ->whereBetween('pembelian.created_at', [$tanggal_awal, $tanggal_akhir])
            ->where('detail_pembelian.supplier_id', $supplier)
            ->get();
        return view('laporan.pembelian_pertanggal', compact('title', 'pembelian', 'tanggal_awal', 'tanggal_akhir', 'tanggal_awal1', 'tanggal_akhir1', 'supplier'));
    }

    public function pembelian_pertanggal_download(Request $request)
    {
        $title = 'Pembelian';
        $tanggal_awal1 = date('d-m-Y', strtotime($request->tanggal_awal));
        $tanggal_akhir1 = date('d-m-Y', strtotime($request->tanggal_akhir));
        $supplier = $request->supplier;
        $pembelian = DB::table('pembelian')
            ->join('detail_pembelian', 'pembelian.no_pembelian', 'detail_pembelian.no_pembelian')
            ->join('supplier', 'detail_pembelian.supplier_id', 'supplier.id')
            ->join('barang', 'pembelian.kode_barang', 'barang.kode_barang')
            ->select('pembelian.*', 'detail_pembelian.supplier_id', 'supplier.nama as nama_supplier', 'barang.nama_barang')
            ->whereBetween('pembelian.created_at', [$request->tanggal_awal, $request->tanggal_akhir])
            ->where('detail_pembelian.supplier_id', $supplier)
            ->get();
        $pdf = PDF::loadView('laporan.pembelian_pertanggal_download', compact('title', 'pembelian', 'tanggal_awal1', 'tanggal_akhir1'))->setPaper('a4', 'landscape');
        return $pdf->download('REKAPITULASI-TRANSAKSI-PEMBELIAN-BARANG-' . date('d-m-Y', strtotime($request->tanggal_awal)) . '-SAMPAI-' . date('d-m-Y', strtotime($request->tanggal_akhir)) . '.pdf');
    }

    public function penjualan_harian()
    {
        $title = 'Penjualan Harian';
        $penjualan = Penjualan::orderBy('id', 'desc')->get();
        return view('laporan.penjualan_harian', compact('title', 'penjualan'));
    }

    public function penjualan_harian_cari(Request $request)
    {
        $title = 'Penjualan Harian';
        $tanggal = date('d-m-Y', strtotime($request->tanggal));
        $tanggal1 = $request->tanggal;
        $tanggal_awal = $request->tanggal . " 00:00:00";
        $tanggal_akhir = $request->tanggal . " 23:59:59";
        $penjualan = Penjualan::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->get();
        // dd($penjualan);
        return view('laporan.penjualan_harian_cari', compact('title', 'penjualan', 'tanggal', 'tanggal1'));
    }

    public function penjualan_harian_download(Request $request)
    {
        $title = 'Penjualan Harian';
        $tanggal = date('d-m-Y', strtotime($request->tanggal));
        $tanggal_awal = $request->tanggal . " 00:00:00";
        $tanggal_akhir = $request->tanggal . " 23:59:59";
        $penjualan = Penjualan::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])->get();
        // dd($penjualan);
        $pdf = PDF::loadView('laporan.penjualan_harian_download', compact('title', 'penjualan', 'tanggal'))->setPaper('a4', 'landscape');
        return $pdf->download('LAPORAN-PENJUALAN-HARIAN-' . $tanggal  . '.pdf');
        // return view('laporan.penjualan_harian_download', compact('title', 'penjualan', 'tanggal'));
    }

    public function penjualan_minggu_atau_bulan()
    {
        $title = 'Penjualan Minggu atau Bulan';
        $penjualan = Penjualan::orderBy('id', 'desc')->get();
        return view('laporan.penjualan_minggu_atau_bulan', compact('title', 'penjualan'));
    }

    public function penjualan_minggu_atau_bulan_cari(Request $request)
    {
        $title = 'Penjualan Minggu atau Bulan';
        $tanggal_awal1 = date('d-m-Y', strtotime($request->tanggal_awal));
        $tanggal_akhir1 = date('d-m-Y', strtotime($request->tanggal_akhir));
        $tanggal_awal2 = $request->tanggal_awal;
        $tanggal_akhir2 = $request->tanggal_akhir;
        $tanggal_awal3 = $request->tanggal_awal . " 00:00:00";
        $tanggal_akhir3 = $request->tanggal_akhir . " 23:59:59";
        $penjualan = Penjualan::whereBetween('created_at', [$tanggal_awal3, $tanggal_akhir3])->get();
        // dd($penjualan);
        return view('laporan.penjualan_minggu_atau_bulan_cari', compact('title', 'penjualan', 'tanggal_awal1', 'tanggal_akhir1', 'tanggal_awal2', 'tanggal_akhir2'));
    }

    public function penjualan_minggu_atau_bulan_download(Request $request)
    {
        $title = 'Penjualan Minggu atau Bulan';
        $tanggal_awal1 = date('d-m-Y', strtotime($request->tanggal_awal));
        $tanggal_akhir1 = date('d-m-Y', strtotime($request->tanggal_akhir));
        $tanggal_awal3 = $request->tanggal_awal . " 00:00:00";
        $tanggal_akhir3 = $request->tanggal_akhir . " 23:59:59";
        $penjualan = Penjualan::whereBetween('created_at', [$tanggal_awal3, $tanggal_akhir3])->get();
        // dd($penjualan);
        $pdf = PDF::loadView('laporan.penjualan_minggu_atau_bulan_download', compact('title', 'penjualan', 'tanggal_awal1', 'tanggal_akhir1'))->setPaper('a4', 'landscape');
        return $pdf->download('LAPORAN-PENJUALAN-MINGGU-ATAU-BULAN-' . $tanggal_awal1 . '-SAMPAI-' . $tanggal_akhir1  . '.pdf');
        // return view('laporan.penjualan_minggu_atau_bulan_download', compact('title', 'penjualan', 'tanggal_awal1', 'tanggal_akhir1'));
    }

    public function keuntungan_harian()
    {
        $title = 'Keuntungan Harian';
        $penjualan = Penjualan::orderBy('id', 'desc')->get();
        return view('laporan.keuntungan_harian', compact('title', 'penjualan'));
    }

    public function keuntungan_harian_cari(Request $request)
    {
        $title = 'Keuntungan Harian';
        $tanggal = date('d-m-Y', strtotime($request->tanggal));
        $tanggal1 = $request->tanggal;
        $tanggal_awal = $request->tanggal . " 00:00:00";
        $tanggal_akhir = $request->tanggal . " 23:59:59";
        $detail_penjualan = DB::table('detail_penjualan')
            ->join('barang', 'detail_penjualan.kode_barang', 'barang.kode_barang')
            ->select('detail_penjualan.*', 'barang.nama_barang')
            ->whereBetween('detail_penjualan.created_at', [$tanggal_awal, $tanggal_akhir])
            ->get();
        return view('laporan.keuntungan_harian_cari', compact('title', 'detail_penjualan', 'tanggal', 'tanggal1'));
    }

    public function keuntungan_harian_download(Request $request)
    {
        $title = 'Keuntungan Harian';
        $tanggal = date('d-m-Y', strtotime($request->tanggal));
        $tanggal_awal = $request->tanggal . " 00:00:00";
        $tanggal_akhir = $request->tanggal . " 23:59:59";
        $detail_penjualan = DB::table('detail_penjualan')
            ->join('barang', 'detail_penjualan.kode_barang', 'barang.kode_barang')
            ->select('detail_penjualan.*', 'barang.nama_barang')
            ->whereBetween('detail_penjualan.created_at', [$tanggal_awal, $tanggal_akhir])
            ->get();
        // dd($penjualan);
        $pdf = PDF::loadView('laporan.keuntungan_harian_download', compact('title', 'detail_penjualan', 'tanggal'))->setPaper('a4', 'landscape');
        return $pdf->download('LAPORAN-KEUNTUGAN-HARIAN-' . $tanggal  . '.pdf');
        // return view('laporan.keuntungan_harian_download', compact('title', 'detail_penjualan', 'tanggal'));
    }

    public function keuntungan_minggu_atau_bulan()
    {
        $title = 'Keuntungan Minggu atau Bulan';
        return view('laporan.keuntungan_minggu_atau_bulan', compact('title'));
    }

    public function keuntungan_minggu_atau_bulan_cari(Request $request)
    {
        $title = 'Keuntungan Minggu atau Bulan';
        $tanggal_awal1 = date('d-m-Y', strtotime($request->tanggal_awal));
        $tanggal_akhir1 = date('d-m-Y', strtotime($request->tanggal_akhir));
        $tanggal_awal2 = $request->tanggal_awal;
        $tanggal_akhir2 = $request->tanggal_akhir;
        $tanggal_awal3 = $request->tanggal_awal . " 00:00:00";
        $tanggal_akhir3 = $request->tanggal_akhir . " 23:59:59";
        $detail_penjualan = DB::table('detail_penjualan')
            ->join('barang', 'detail_penjualan.kode_barang', 'barang.kode_barang')
            ->select('detail_penjualan.*', 'barang.nama_barang')
            ->whereBetween('detail_penjualan.created_at', [$tanggal_awal3, $tanggal_akhir3])
            ->get();
        // dd($penjualan);
        return view('laporan.keuntungan_minggu_atau_bulan_cari', compact('title', 'detail_penjualan', 'tanggal_awal1', 'tanggal_akhir1', 'tanggal_awal2', 'tanggal_akhir2'));
    }

    public function keuntungan_minggu_atau_bulan_download(Request $request)
    {
        $title = 'Keuntungan Minggu atau Bulan';
        $tanggal_awal1 = date('d-m-Y', strtotime($request->tanggal_awal));
        $tanggal_akhir1 = date('d-m-Y', strtotime($request->tanggal_akhir));
        $tanggal_awal3 = $request->tanggal_awal . " 00:00:00";
        $tanggal_akhir3 = $request->tanggal_akhir . " 23:59:59";
        $detail_penjualan = DB::table('detail_penjualan')
            ->join('barang', 'detail_penjualan.kode_barang', 'barang.kode_barang')
            ->select('detail_penjualan.*', 'barang.nama_barang')
            ->whereBetween('detail_penjualan.created_at', [$tanggal_awal3, $tanggal_akhir3])
            ->get();
        // dd($penjualan);
        $pdf = PDF::loadView('laporan.keuntungan_minggu_atau_bulan_download', compact('title', 'detail_penjualan', 'tanggal_awal1', 'tanggal_akhir1'))->setPaper('a4', 'landscape');
        return $pdf->download('LAPORAN-KEUNTUGAN-MINGGU-ATAU-BULAN-' . $tanggal_awal1 . '-SAMPAI-' . $tanggal_akhir1  . '.pdf');
        // return view('laporan.keuntungan_minggu_atau_bulan_download', compact('title', 'detail_penjualan', 'tanggal_awal1', 'tanggal_akhir1'));
    }

    public function detail_penjualan($no_invoice)
    {
        $penjualan = Penjualan::where('no_invoice', $no_invoice)->first();
        $detail_penjualan = DB::table('detail_penjualan')
            ->join('barang', 'detail_penjualan.kode_barang', 'barang.kode_barang')
            ->select('detail_penjualan.*', 'barang.nama_barang')
            ->where('detail_penjualan.no_invoice', $no_invoice)
            ->get();
        return view('laporan.detail_penjualan', compact('penjualan', 'detail_penjualan'));
    }

    public function detail_penjualan_download($no_invoice)
    {
        $penjualan = Penjualan::where('no_invoice', $no_invoice)->first();
        $detail_penjualan = DB::table('detail_penjualan')
            ->join('barang', 'detail_penjualan.kode_barang', 'barang.kode_barang')
            ->select('detail_penjualan.*', 'barang.nama_barang')
            ->where('detail_penjualan.no_invoice', $no_invoice)
            ->get();
        $pdf = PDF::loadView('laporan.detail_penjualan_download', compact('penjualan', 'detail_penjualan'))->setPaper('a4', 'landscape');
        return $pdf->download('LAPORAN-DETAIL-PENJUALAN-NO-INVOICE-' . $no_invoice . '.pdf');
        // return view('laporan.detail_penjualan_download', compact('penjualan', 'detail_penjualan'));
    }

    public function produk_terjual()
    {
        $title = 'Produk Terjual';
        return view('laporan.produk_terjual', compact('title'));
    }

    public function produk_terjual_cari(Request $request)
    {
        $kode_barang = explode("/", $request->kode_barang);
        $tanggal_awal = $request->tanggal_awal . " 00:00:00";
        $tanggal_akhir = $request->tanggal_akhir . " 23:59:59";
        $tanggal_awal1 = date('d-m-Y', strtotime($request->tanggal_awal));
        $tanggal_akhir1 = date('d-m-Y', strtotime($request->tanggal_akhir));
        $kode_barang1 = $kode_barang[0];
        $title = 'Penjualan';
        $detail_penjualan = DB::table('detail_penjualan')
            ->join('barang', 'detail_penjualan.kode_barang', 'barang.kode_barang')
            ->select('detail_penjualan.*', 'barang.nama_barang')
            ->where('detail_penjualan.kode_barang', $kode_barang[0])
            ->whereBetween('detail_penjualan.created_at', [$tanggal_awal, $tanggal_akhir])
            ->get();
        // dd($detail_penjualan);
        return view('laporan.produk_terjual_cari', compact('title',  'kode_barang1', 'detail_penjualan', 'tanggal_awal', 'tanggal_akhir', 'tanggal_awal1', 'tanggal_akhir1'));
    }

    public function produk_terjual_download(Request $request)
    {
        $tanggal_awal1 = date('d-m-Y', strtotime($request->tanggal_awal));
        $tanggal_akhir1 = date('d-m-Y', strtotime($request->tanggal_akhir));

        $title = 'Penjualan';
        $detail_penjualan = DB::table('detail_penjualan')
            ->join('barang', 'detail_penjualan.kode_barang', 'barang.kode_barang')
            ->select('detail_penjualan.*', 'barang.nama_barang')
            ->where('detail_penjualan.kode_barang', $request->kode_barang)
            ->whereBetween('detail_penjualan.created_at', [$request->tanggal_awal, $request->tanggal_akhir])
            ->get();
        $pdf = PDF::loadView('laporan.produk_terjual_download', compact('title', 'detail_penjualan', 'tanggal_awal1', 'tanggal_akhir1'))->setPaper('a4', 'landscape');
        return $pdf->download('REKAPITULASI-PRODUK-TERJUAL-' . $request->kode_barang . '-' . $tanggal_awal1 . '-SAMPAI-' . $tanggal_akhir1 . '.pdf');
    }

    public function retur()
    {
        $title = 'Retur Barang';
        return view('laporan.retur', compact('title'));
    }

    public function retur_semua()
    {
        $title = 'Retur Barang';
        $detail_retur_barang = DB::table('detail_retur_barang')
            ->join('retur_barang', 'detail_retur_barang.no_retur', 'retur_barang.no_retur')
            ->join('barang', 'detail_retur_barang.kode_barang', 'barang.kode_barang')
            ->join('pelanggan', 'retur_barang.pelanggan_id', 'pelanggan.id')
            ->select('detail_retur_barang.*', 'retur_barang.*', 'barang.nama_barang', 'pelanggan.nama as nama_pelanggan')
            ->get();
        return view('laporan.retur_semua', compact('title', 'detail_retur_barang'));
    }

    public function retur_semua_download()
    {
        $title = 'Retur Barang';
        $detail_retur_barang = DB::table('detail_retur_barang')
            ->join('retur_barang', 'detail_retur_barang.no_retur', 'retur_barang.no_retur')
            ->join('barang', 'detail_retur_barang.kode_barang', 'barang.kode_barang')
            ->join('pelanggan', 'retur_barang.pelanggan_id', 'pelanggan.id')
            ->select('detail_retur_barang.*', 'retur_barang.*', 'barang.nama_barang', 'pelanggan.nama as nama_pelanggan')
            ->get();
        $pdf = PDF::loadView('laporan.retur_semua_download', compact('title', 'detail_retur_barang'))->setPaper('a4', 'landscape');
        return $pdf->download('REKAPITULASI-RETUR-BARANG.pdf');
    }

    public function retur_pertanggal(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal . " 00:00:00";
        $tanggal_akhir = $request->tanggal_akhir . " 23:59:59";

        $tanggal_awal1 = date('d-m-Y', strtotime($request->tanggal_awal));
        $tanggal_akhir1 = date('d-m-Y', strtotime($request->tanggal_akhir));

        $title = 'Retur Barang';
        $detail_retur_barang = DB::table('detail_retur_barang')
            ->join('retur_barang', 'detail_retur_barang.no_retur', 'retur_barang.no_retur')
            ->join('barang', 'detail_retur_barang.kode_barang', 'barang.kode_barang')
            ->join('pelanggan', 'retur_barang.pelanggan_id', 'pelanggan.id')
            ->select('detail_retur_barang.*', 'retur_barang.*', 'barang.nama_barang', 'pelanggan.nama as nama_pelanggan')
            ->whereBetween('detail_retur_barang.created_at', [$tanggal_awal, $tanggal_akhir])
            ->get();
        return view('laporan.retur_pertanggal', compact('title', 'detail_retur_barang', 'tanggal_awal', 'tanggal_akhir', 'tanggal_awal1', 'tanggal_akhir1'));
    }

    public function retur_pertanggal_download(Request $request)
    {
        $tanggal_awal1 = date('d-m-Y', strtotime($request->tanggal_awal));
        $tanggal_akhir1 = date('d-m-Y', strtotime($request->tanggal_akhir));

        $title = 'Retur Barang';
        $detail_retur_barang = DB::table('detail_retur_barang')
            ->join('retur_barang', 'detail_retur_barang.no_retur', 'retur_barang.no_retur')
            ->join('barang', 'detail_retur_barang.kode_barang', 'barang.kode_barang')
            ->join('pelanggan', 'retur_barang.pelanggan_id', 'pelanggan.id')
            ->select('detail_retur_barang.*', 'retur_barang.*', 'barang.nama_barang', 'pelanggan.nama as nama_pelanggan')
            ->whereBetween('detail_retur_barang.created_at', [$request->tanggal_awal, $request->tanggal_akhir])
            ->get();
        $pdf = PDF::loadView('laporan.retur_pertanggal_download', compact('title', 'detail_retur_barang', 'tanggal_awal1', 'tanggal_akhir1'))->setPaper('a4', 'landscape');
        return $pdf->download('REKAPITULASI RETUR BARANG ' . $tanggal_awal1 . '-SAMPAI-' . $tanggal_akhir1 . '.pdf');
    }

    public function hutang()
    {
        $title = 'Hutang';
        return view('laporan.hutang', compact('title'));
    }

    public function hutang_semua()
    {
        $title = 'Hutang';
        $hutang = DB::table('hutang')
            ->join('pelanggan', 'hutang.pelanggan_id', 'pelanggan.id')
            ->select('hutang.*', 'pelanggan.nama as nama_pelanggan')
            ->get();
        return view('laporan.hutang_semua', compact('title', 'hutang'));
    }

    public function hutang_semua_download()
    {
        $title = 'Hutang';
        $hutang = DB::table('hutang')
            ->join('pelanggan', 'hutang.pelanggan_id', 'pelanggan.id')
            ->select('hutang.*', 'pelanggan.nama as nama_pelanggan')
            ->get();
        $pdf = PDF::loadView('laporan.hutang_semua_download', compact('title', 'hutang'))->setPaper('a4', 'landscape');
        return $pdf->download('REKAPITULASI-TRANSAKSI-HUTANG.pdf');
    }

    public function hutang_pertanggal(Request $request)
    {
        $status = $request->status;
        $tanggal_awal = $request->tanggal_awal . " 00:00:00";
        $tanggal_akhir = $request->tanggal_akhir . " 23:59:59";

        $tanggal_awal1 = date('d-m-Y', strtotime($request->tanggal_awal));
        $tanggal_akhir1 = date('d-m-Y', strtotime($request->tanggal_akhir));

        $title = 'Hutang';
        $hutang = DB::table('hutang')
            ->join('pelanggan', 'hutang.pelanggan_id', 'pelanggan.id')
            ->select('hutang.*', 'pelanggan.nama as nama_pelanggan')
            ->where('status', $request->status)
            ->whereBetween('hutang.created_at', [$tanggal_awal, $tanggal_akhir])
            ->get();
        return view('laporan.hutang_pertanggal', compact('title', 'hutang', 'tanggal_awal', 'tanggal_akhir', 'tanggal_awal1', 'tanggal_akhir1', 'status'));
    }

    public function hutang_pertanggal_download(Request $request)
    {
        $status = $request->status;
        $tanggal_awal1 = date('d-m-Y', strtotime($request->tanggal_awal));
        $tanggal_akhir1 = date('d-m-Y', strtotime($request->tanggal_akhir));

        $title = 'Hutang';
        $hutang = DB::table('hutang')
            ->join('pelanggan', 'hutang.pelanggan_id', 'pelanggan.id')
            ->select('hutang.*', 'pelanggan.nama as nama_pelanggan')
            ->where('status', $request->status)
            ->whereBetween('hutang.created_at', [$request->tanggal_awal, $request->tanggal_akhir])
            ->get();
        $pdf = PDF::loadView('laporan.hutang_pertanggal_download', compact('title', 'hutang', 'tanggal_awal1', 'tanggal_akhir1', 'status'))->setPaper('a4', 'landscape');
        if ($status == 0) {
            return $pdf->download('REKAPITULASI-TRANSAKSI-HUTANG-BELUM-LUNAS-' . $tanggal_awal1 . '-SAMPAI-' . $tanggal_akhir1 . '.pdf');
        } else {
            return $pdf->download('REKAPITULASI-TRANSAKSI-HUTANG-SUDAH-LUNAS-' . $tanggal_awal1 . '-SAMPAI-' . $tanggal_akhir1 . '.pdf');
        }
    }

    public function pengeluaran()
    {
        $title = 'Pengeluaran';
        return view('laporan.pengeluaran', compact('title'));
    }

    public function pengeluaran_semua()
    {
        $title = 'Pengeluaran';
        $pengeluaran = DB::table('pengeluaran')->get();
        return view('laporan.pengeluaran_semua', compact('title', 'pengeluaran'));
    }

    public function pengeluaran_semua_download()
    {
        $title = 'Pengeluaran';
        $pengeluaran = DB::table('pengeluaran')->get();
        $pdf = PDF::loadView('laporan.pengeluaran_semua_download', compact('title', 'pengeluaran'))->setPaper('a4', 'landscape');
        return $pdf->download('REKAPITULASI-TRANSAKSI-PENGELUARAN.pdf');
    }

    public function pengeluaran_pertanggal(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal . " 00:00:00";
        $tanggal_akhir = $request->tanggal_akhir . " 23:59:59";

        $tanggal_awal1 = date('d-m-Y', strtotime($request->tanggal_awal));
        $tanggal_akhir1 = date('d-m-Y', strtotime($request->tanggal_akhir));

        $title = 'Pengeluaran';
        $pengeluaran = DB::table('pengeluaran')
            ->whereBetween('pengeluaran.created_at', [$tanggal_awal, $tanggal_akhir])
            ->get();
        return view('laporan.pengeluaran_pertanggal', compact('title', 'pengeluaran', 'tanggal_awal', 'tanggal_akhir', 'tanggal_awal1', 'tanggal_akhir1'));
    }

    public function pengeluaran_pertanggal_download(Request $request)
    {
        $tanggal_awal1 = date('d-m-Y', strtotime($request->tanggal_awal));
        $tanggal_akhir1 = date('d-m-Y', strtotime($request->tanggal_akhir));

        $title = 'Pengeluaran';
        $pengeluaran = DB::table('pengeluaran')
            ->whereBetween('pengeluaran.created_at', [$request->tanggal_awal, $request->tanggal_akhir])
            ->get();
        $pdf = PDF::loadView('laporan.pengeluaran_pertanggal_download', compact('title', 'pengeluaran', 'tanggal_awal1', 'tanggal_akhir1'))->setPaper('a4', 'landscape');
        return $pdf->download('REKAPITULASI-TRANSAKSI-PENGELUARAN-' . $tanggal_awal1 . '-SAMPAI-' . $tanggal_akhir1 . '.pdf');
    }

    public function keuangan()
    {
        $title = 'Keuangan';
        return view('laporan.keuangan', compact('title'));
    }

    public function keuangan_cari(Request $request)
    {
        $title = 'Keuangan';

        $tanggal_awal1 = date('d-m-Y', strtotime($request->tanggal_awal));
        $tanggal_akhir1 = date('d-m-Y', strtotime($request->tanggal_akhir));
        $tanggal_awal2 = $request->tanggal_awal;
        $tanggal_akhir2 = $request->tanggal_akhir;
        $tanggal_awal3 = $request->tanggal_awal . " 00:00:00";
        $tanggal_akhir3 = $request->tanggal_akhir . " 23:59:59";

        $total_keuntungan = 0;
        $keuntungan = DB::table('detail_penjualan')->whereBetween('created_at', [$tanggal_awal3, $tanggal_akhir3])->get();
        foreach ($keuntungan as $value) {
            $total_keuntungan += $value->qty * $value->profit - $value->potongan;
        }

        $total_pengeluaran = 0;
        $pengeluaran = DB::table('pengeluaran')->whereBetween('created_at', [$tanggal_awal3, $tanggal_akhir3])->get();
        foreach ($pengeluaran as $value) {
            $total_pengeluaran += $value->jumlah;
        }
        return view('laporan.keuangan_cari', compact('title', 'total_keuntungan', 'total_pengeluaran', 'tanggal_awal1', 'tanggal_akhir1', 'tanggal_awal2', 'tanggal_akhir2'));
    }

    public function keuangan_download(Request $request)
    {
        $title = 'Keuangan';
        $tanggal_awal1 = date('d-m-Y', strtotime($request->tanggal_awal));
        $tanggal_akhir1 = date('d-m-Y', strtotime($request->tanggal_akhir));
        $tanggal_awal2 = $request->tanggal_awal . " 00:00:00";
        $tanggal_akhir2 = $request->tanggal_akhir . " 23:59:59";
        $total_keuntungan = 0;
        $keuntungan = DB::table('detail_penjualan')->whereBetween('created_at', [$tanggal_awal2, $tanggal_akhir2])->get();
        foreach ($keuntungan as $value) {
            $total_keuntungan += $value->qty * $value->profit - $value->potongan;
        }

        $total_pengeluaran = 0;
        $pengeluaran = DB::table('pengeluaran')->whereBetween('created_at', [$tanggal_awal2, $tanggal_akhir2])->get();
        foreach ($pengeluaran as $value) {
            $total_pengeluaran += $value->jumlah;
        }
        // dd($penjualan);
        $pdf = PDF::loadView('laporan.keuangan_download', compact('title', 'total_keuntungan', 'total_pengeluaran', 'tanggal_awal1', 'tanggal_akhir1'))->setPaper('a4', 'landscape');
        return $pdf->download('LAPORAN-KEUANGAN-' . $tanggal_awal1 . '-SAMPAI-' . $tanggal_akhir1  . '.pdf');
        // return view('laporan.keuangan_download', compact('title', 'total_keuntungan', 'total_pengeluaran', 'tanggal_awal1', 'tanggal_akhir1'));
    }

    public function stok_barang()
    {
        $title = 'Stok Barang';
        $barang = Barang::all();
        $total = $barang->sum(function ($barang) {
            return $barang->harga_beli * $barang->stok;
        });
        return view('laporan.stok_barang', compact('title', 'barang', 'total'));
    }

    public function stok_barang_download_pdf()
    {
        $title = 'Stok Barang';
        $barang = Barang::all();
        $pdf = PDF::loadView('laporan.stok_barang_download_pdf', compact('title', 'barang'))->setPaper('a4', 'landscape');
        return $pdf->download('LAPORAN-STOK-BARANG.pdf');
        // return view('laporan.stok_barang_download_pdf', compact('title', 'barang'));
    }
}
