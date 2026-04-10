<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Detail_penjualan;
use App\DetailPejualan;
use App\Hutang;
use App\Pelanggan;
use App\Penjualan;
use App\StokBarang;
use Carbon\Carbon;
use App\Bank;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($no_invoice)
    {
        // $title = 'Penjualan';
        // $penjualan = Penjualan::orderBy('id', 'desc')->get();
        // return view('penjualan.index', compact('title', 'penjualan'));
        $title = 'Penjualan';
        $barang = Barang::all();
        $detail_penjualan = DB::table('detail_penjualan')
            ->join('barang', 'detail_penjualan.kode_barang', 'barang.kode_barang')
            ->select('detail_penjualan.*', 'barang.nama_barang')
            ->where('detail_penjualan.no_invoice', $no_invoice)
            ->orderBy('detail_penjualan.id', 'desc')
            ->get();
        // $detail_penjualan = DetailPejualan::orderBy('id', 'desc')->where('no_invoice', $no_invoice)->get();
        $pelanggan = Pelanggan::all();
        $banks = Bank::all();
        return view('penjualan.create', compact('title', 'barang', 'detail_penjualan', 'pelanggan', 'banks'));
    }

    public function create($no_invoice)
    {
        // $title = 'Penjualan';
        // $barang = DB::table('barang')
        //     ->join('stok_barang', 'barang.kode_barang', 'stok_barang.kode_barang')
        //     ->select('barang.*', 'stok_barang.qty as stok_barang')
        //     ->get();
        // $detail_penjualan = DB::table('detail_penjualan')
        //     ->join('barang', 'detail_penjualan.kode_barang', 'barang.kode_barang')
        //     ->select('detail_penjualan.*', 'barang.nama_barang')
        //     ->where('detail_penjualan.no_invoice', $no_invoice)
        //     ->orderBy('detail_penjualan.id', 'desc')
        //     ->get();
        // $pelanggan = Pelanggan::all();
        // return view('penjualan.create', compact('title', 'barang', 'detail_penjualan', 'pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if ($request->jenis == 'cash' || $request->jenis == 'transfer') {
            $penjualan = new Penjualan;
            $penjualan->user_id = Auth::user()->id;
            $penjualan->pelanggan_id = $request->pelanggan_id;
            $penjualan->no_invoice = $request->no_invoice;
            $penjualan->total_pembayaran = $request->total_pembayaran;
            $penjualan->sub_total = $request->sub_total;
            $penjualan->pembayaran = $request->pembayaran;
            $penjualan->kembalian = $request->kembalian;
            $penjualan->jenis = $request->jenis;
            $penjualan->jenis_bank = $request->jenis_bank;
            if ($request->jenis == 'transfer' && $request->bank_id) {
                $bank = Bank::find($request->bank_id);
                if ($bank) {
                    $penjualan->bank_id = $bank->id;
                    $penjualan->bank_nama = $bank->nama_bank;
                    $penjualan->bank_rekening = $bank->no_rekening;
                    $penjualan->bank_atas_nama = $bank->atas_nama;
                }
            }
            $penjualan->biaya_pengiriman = $request->biaya_pengiriman;
            $penjualan->keterangan = $request->keterangan;
            if ($request->hasFile('bukti_transfer')) {
                $bukti_transfer = $request->file('bukti_transfer');
                $nama_bukti_transfer = time() . '_' . $bukti_transfer->getClientOriginalName();
                $bukti_transfer->move('bukti_transfer', $nama_bukti_transfer);
                $penjualan->bukti_transfer = $nama_bukti_transfer;
            }
            $penjualan->save();
            return redirect('/penjualan/' . no_invoice())->with('print_struk', $penjualan->id)->with('success', 'Transaksi Berhasil Disimpan');
        } else {
            $penjualan = new Penjualan;
            $penjualan->user_id = Auth::user()->id;
            $penjualan->pelanggan_id = $request->pelanggan_id;
            $penjualan->no_invoice = $request->no_invoice;
            $penjualan->total_pembayaran = $request->total_pembayaran;
            $penjualan->sub_total = $request->sub_total;
            $penjualan->pembayaran = $request->pembayaran;
            $penjualan->kembalian = $request->kembalian;
            $penjualan->jenis = $request->jenis;
            $penjualan->keterangan = $request->keterangan;
            $penjualan->save();

            $hutang = new Hutang;
            $hutang->pelanggan_id = $request->pelanggan_id;
            $hutang->no_invoice = $request->no_invoice;
            $hutang->sub_total = $request->sub_total;
            $hutang->save();

            return redirect('/penjualan/' . no_invoice())->with('print_struk', $penjualan->id)->with('success', 'Transaksi Berhasil Disimpan');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function detail_penjualan(Request $request)
    {
        $harga_jual = $request->harga;
        $kode_barang = explode("/", $request->kode_barang);
        $barang = Barang::where('kode_barang', $kode_barang[0])->first();
        if (!$barang) {
            return redirect('/penjualan/' . $request->no_invoice)->with('warning', 'Barang tidak ditemukan');
        }

        $cek_kode_barang = DetailPejualan::where('kode_barang', $kode_barang[0])->where('no_invoice', $request->no_invoice)->first();
        
        if ($cek_kode_barang) {
            $update_stok_barang = Barang::where('kode_barang', $kode_barang[0])->first();

            $cek_kode_barang->qty = $cek_kode_barang->qty + $request->qty;
            $cek_kode_barang->potongan = $cek_kode_barang->potongan + $request->potongan;
            $cek_kode_barang->total_harga = ($harga_jual * $cek_kode_barang->qty) - $cek_kode_barang->potongan;
            $cek_kode_barang->save();

            if (!$update_stok_barang->is_jasa) {
                $update_stok_barang->stok = $update_stok_barang->stok - $request->qty;
                $update_stok_barang->save();

                if ($update_stok_barang->stok <= $update_stok_barang->stok_minimal) {
                    return redirect('/penjualan/' . $request->no_invoice)->with('warning', 'Stok kode barang ' . $update_stok_barang->kode_barang . ' sudah kurang dari minimal stok, harap segera tambahkan stok barang tersebut');
                }
            }

            return redirect('/penjualan/' . $request->no_invoice);

        } else {
            $update_stok_barang = Barang::where('kode_barang', $kode_barang[0])->first();

            $detail_penjualan = new DetailPejualan;
            $detail_penjualan->no_invoice = $request->no_invoice;
            $detail_penjualan->kode_barang = $kode_barang[0];
            $detail_penjualan->harga = $harga_jual;
            $detail_penjualan->qty = $request->qty;
            $detail_penjualan->potongan = $request->potongan;
            $detail_penjualan->total_harga = ($harga_jual * $request->qty) - $request->potongan;
            $detail_penjualan->jenis = 'jual'; // default label for one price
            $detail_penjualan->profit = $barang->profit_harga_ecer;
            $detail_penjualan->save();

            if (!$update_stok_barang->is_jasa) {
                $update_stok_barang->stok = $update_stok_barang->stok - $request->qty;
                $update_stok_barang->save();

                if ($update_stok_barang->stok <= $update_stok_barang->stok_minimal) {
                    return redirect('/penjualan/' . $request->no_invoice)->with('warning', 'Stok kode barang ' . $update_stok_barang->kode_barang . ' sudah kurang dari minimal stok, harap segera tambahkan stok barang tersebut');
                }
            }

            return redirect('/penjualan/' . $request->no_invoice);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detail_penjualan = DetailPejualan::find($id);

        $update_stok_barang = Barang::where('kode_barang', $detail_penjualan->kode_barang)->first();
        // Only restore stock for physical items, not services
        if ($update_stok_barang && !$update_stok_barang->is_jasa) {
            $update_stok_barang->stok = $update_stok_barang->stok + $detail_penjualan->qty;
            $update_stok_barang->save();
        }

        $detail_penjualan->delete();
        return redirect('/penjualan/' . $detail_penjualan->no_invoice);
    }

    public function struk($id)
    {
        $title = 'Penjualan';
        $penjualan = Penjualan::find($id);
        // dd($penjualan);
        $detail_penjualan = DB::table('detail_penjualan')
            ->join('barang', 'detail_penjualan.kode_barang', 'barang.kode_barang')
            ->select('detail_penjualan.*', 'barang.nama_barang')
            ->where('detail_penjualan.no_invoice', $penjualan->no_invoice)
            ->get();
        return view('penjualan.struk', compact('title', 'penjualan', 'detail_penjualan'));
    }

    public function downloadPDF($id)
    {
        $penjualan = Penjualan::find($id);
        $detail_penjualan = DB::table('detail_penjualan')
            ->join('barang', 'detail_penjualan.kode_barang', 'barang.kode_barang')
            ->select('detail_penjualan.*', 'barang.nama_barang')
            ->where('detail_penjualan.no_invoice', $penjualan->no_invoice)
            ->get();

        $pdf = PDF::loadView('penjualan.struk_pdf', compact('penjualan', 'detail_penjualan'));
        return $pdf->download('Nota-' . $penjualan->no_invoice . '.pdf');
    }

    function ambil_data_barang(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $barang = Barang::select('id', 'id')->limit(5)->get();
        } else {
            $barang = Barang::select("*")
                ->where('kode_barang', 'like', '%' . $search . '%')
                ->orWhere('nama_barang', 'like', '%' . $search . '%')
                ->get();
        }

        $result = [];
        foreach ($barang as $b) {
            $result[] = [
                "label" => $b->kode_barang . '/' . $b->nama_barang,
                "nama_barang" => $b->nama_barang,
                "harga_ecer" => $b->harga_ecer,
                "harga_grosir" => $b->harga_grosir,
                "harga_agen" => $b->harga_agen,
                "stok" => $b->stok,
                "harga_custom" => $b->harga_custom,
                "harga_customb" => $b->harga_customb,
                "harga_customc" => $b->harga_customc,
                "harga_customd" => $b->harga_customd,
                "harga_custome" => $b->harga_custome,
                "harga_customf" => $b->harga_customf,
                "harga_customg" => $b->harga_customg,
            ];
        }

        return response()->json($result);
    }
}
