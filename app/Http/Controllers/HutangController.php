<?php

namespace App\Http\Controllers;

use App\DetailHutang;
use App\Hutang;
use App\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class HutangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Hutang';
        $hutang = Hutang::orderBy('id', 'desc')->get();
        return view('hutang.index', compact('title', 'hutang'));
    }

    public function edit($id)
    {
        $title = 'Hutang';
        $hutang = Hutang::find($id);
        return view('hutang.edit', compact('title', 'hutang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hutang  $hutang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $detail_hutang = DB::table('detail_hutang')->insert([
            'no_invoice' => $request->no_invoice,
            'pembayaran' => $request->pembayaran,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $hutang = Hutang::find($id);
        $hutang->user_id = Auth::user()->id;
        $hutang->pembayaran = $hutang->pembayaran + $request->pembayaran;
        if ($hutang->sub_total == $hutang->pembayaran) {
            $hutang->status = 1;
        }
        $hutang->save();

        return redirect('/hutang')->with('success', 'Data hutang berhasil terupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hutang  $hutang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hutang = Hutang::find($id);
        $hutang->delete();
        return redirect('/hutang')->with('success', 'Data hutang berhasil terhapus');
    }

    public function detail($id)
    {
        $title = 'Hutang';
        $hutang = Hutang::find($id);
        $penjualan = Penjualan::where('no_invoice', $hutang->no_invoice)->first();
        $detail_hutang = DetailHutang::where('no_invoice', $hutang->no_invoice)->get();
        return view('hutang.detail', compact('title', 'hutang', 'detail_hutang', 'penjualan'));
    }

    public function download($id)
    {
        $title = 'Hutang';
        $hutang = Hutang::find($id);
        $penjualan = Penjualan::where('no_invoice', $hutang->no_invoice)->first();
        $detail_hutang = DetailHutang::where('no_invoice', $hutang->no_invoice)->get();
        $pdf = PDF::loadView('hutang.download', compact('title', 'hutang', 'detail_hutang', 'penjualan'));
        return $pdf->download('Detail-Hutang-' . $penjualan->pelanggan->nama . '-' . date('d-m-Y', strtotime($penjualan->created_at)) . '.pdf');
        // return view('hutang.detail', compact('title', 'hutang', 'detail_penjualan', 'penjualan'));
    }
}
