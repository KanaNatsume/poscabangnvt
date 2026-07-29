<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use App\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Transfer';
        $transfer = Transfer::orderBy('id', 'desc')->get();
        return view('transfer.index', compact('title', 'transfer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Transfer';
        $pelanggan = Pelanggan::all();
        return view('transfer.create', compact('title', 'pelanggan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transfer = new Transfer;
        $transfer->pelanggan_id = $request->pelanggan_id;
        $transfer->nama = $request->nama;
        $transfer->total = $request->total;
        $transfer->keterangan = $request->keterangan;
        if ($request->hasFile('bukti')) {
            $bukti = $request->file('bukti');
            $nama_file = time() . '_' . $bukti->getClientOriginalName();
            $bukti->move('bukti_transfer', $nama_file);
            $transfer->bukti = $nama_file;
            $transfer->save();
        }
        $transfer->save();
        return redirect('/transfer')->with('success', 'Data Transfer berhasil tersimpan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Transfer';
        $transfer = Transfer::find($id);
        $pelanggan = Pelanggan::all();
        return view('transfer.edit', compact('title', 'transfer', 'pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transfer = Transfer::find($id);
        $transfer->pelanggan_id = $request->pelanggan_id;
        $transfer->nama = $request->nama;
        $transfer->total = $request->total;
        if ($request->hasFile('bukti')) {
            $bukti = $request->file('bukti');
            $nama_file = time() . '_' . $bukti->getClientOriginalName();
            $bukti->move('bukti_transfer', $nama_file);
            File::delete('bukti_transfer/' . $transfer->bukti);
            $transfer->bukti = $nama_file;
            $transfer->save();
        }
        $transfer->keterangan = $request->keterangan;
        $transfer->save();
        return redirect('/transfer')->with('success', 'Data Transfer berhasil terupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transfer = Transfer::find($id);
        File::delete('bukti_transfer/' . $transfer->bukti);
        $transfer->delete();
        return redirect('/transfer')->with('success', 'Data Transfer berhasil terhapus');
    }
}
