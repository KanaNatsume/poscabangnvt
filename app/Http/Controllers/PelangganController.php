<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Pelanggan';
        $pelanggan = Pelanggan::orderBy('id', 'desc')->get();
        return view('pelanggan.index', compact('title', 'pelanggan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Pelanggan::create($request->all());
        return redirect('/pelanggan')->with('success', 'Data Pelanggan berhasil tersimpan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pelanggan  $Pelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Pelanggan = Pelanggan::find($id);
        $Pelanggan->nama = $request->edit_nama;
        $Pelanggan->no_hp = $request->edit_no_hp;
        $Pelanggan->alamat = $request->edit_alamat;
        $Pelanggan->save();
        return redirect('/pelanggan')->with('success', 'Data Pelanggan berhasil terupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pelanggan  $Pelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Pelanggan = Pelanggan::find($id);
        $Pelanggan->delete();
        return redirect('/pelanggan')->with('success', 'Data Pelanggan berhasil terhapus');
    }

    /**
     * Store a newly created resource via AJAX.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeAjax(Request $request)
    {
        $pelanggan = Pelanggan::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat
        ]);

        return response()->json([
            'success' => true,
            'data' => $pelanggan
        ]);
    }
}
