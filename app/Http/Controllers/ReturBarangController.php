<?php

namespace App\Http\Controllers;

use App\Barang;
use App\DetailReturBarang;
use App\Pelanggan;
use App\Penjualan;
use App\ReturBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ReturBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Retur Barang';
        $retur_barang = ReturBarang::orderBy('id', 'desc')->get();
        return view('return_barang.index', compact('title', 'retur_barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($no_retur)
    {
        $title = 'Retur Barang';
        $penjualan = Penjualan::all();
        $barang = Barang::all();
        $pelanggan = Pelanggan::all();
        $detail_retur_barang = DB::table('detail_retur_barang')
            ->join('barang', 'detail_retur_barang.kode_barang', 'barang.kode_barang')
            ->select('detail_retur_barang.*', 'barang.nama_barang')
            ->where('detail_retur_barang.no_retur', $no_retur)
            ->orderBy('detail_retur_barang.id', 'desc')
            ->get();
        return view('return_barang.create', compact('title', 'penjualan', 'barang', 'pelanggan', 'detail_retur_barang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $return_barang = new ReturBarang;
        $return_barang->pelanggan_id = $request->pelanggan_id;
        $return_barang->no_retur = $request->no_retur;
        $return_barang->total_pembayaran = $request->total_pembayaran;
        $return_barang->pembayaran = $request->pembayaran;
        $return_barang->kembalian = $request->kembalian;
        $return_barang->save();
        return redirect('/retur/tambah/' . no_retur())->with('success', 'Data retur berhasil tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReturBarang  $returBarang
     * @return \Illuminate\Http\Response
     */
    public function show(ReturBarang $returBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReturBarang  $returBarang
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturBarang $returBarang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReturBarang  $returBarang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReturBarang $returBarang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReturBarang  $returBarang
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturBarang $returBarang)
    {
        //
    }

    public function detail_retur_barang(Request $request)
    {
        $pecah = explode(",", $request->harga);

        $detail_retur_barang = new DetailReturBarang();
        $detail_retur_barang->no_retur = $request->no_retur;
        $detail_retur_barang->no_invoice = $request->no_invoice;
        $detail_retur_barang->kode_barang = $request->kode_barang;
        $detail_retur_barang->harga = $pecah[0];
        $detail_retur_barang->qty = $request->qty;
        $detail_retur_barang->jenis = $pecah[1];
        $detail_retur_barang->keterangan = $request->keterangan;
        $detail_retur_barang->save();
        return redirect('/retur/tambah/' . $request->no_retur);
    }

    public function detail($id)
    {
        $title = 'Retur Barang';
        $retur_barang = ReturBarang::find($id);
        $detail_retur_barang = DB::table('detail_retur_barang')
            ->join('barang', 'detail_retur_barang.kode_barang', 'barang.kode_barang')
            ->select('detail_retur_barang.*', 'barang.nama_barang')
            ->where('detail_retur_barang.no_retur', $retur_barang->no_retur)
            ->get();
        return view('return_barang.detail', compact('title', 'retur_barang', 'detail_retur_barang'));
    }

    public function download($id)
    {
        $title = 'Retur Barang';
        $retur_barang = ReturBarang::find($id);
        $detail_retur_barang = DB::table('detail_retur_barang')
            ->join('barang', 'detail_retur_barang.kode_barang', 'barang.kode_barang')
            ->select('detail_retur_barang.*', 'barang.nama_barang')
            ->where('detail_retur_barang.no_retur', $retur_barang->no_retur)
            ->get();
        $pdf = PDF::loadView('return_barang.download', compact('title', 'retur_barang', 'detail_retur_barang'));
        return $pdf->download('Retur Barang ' . $retur_barang->pelanggan->nama . '.pdf');
    }

    public function hapus_detail_retur_barang($id)
    {
        $row = DetailReturBarang::find($id);
        $row->delete();
        return redirect('/retur/tambah/' . $row->no_retur);
    }
}
