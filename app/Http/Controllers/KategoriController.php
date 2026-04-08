<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Kategori';
        $kategori = Kategori::with('barang')->orderBy('id', 'desc')->get();
        foreach ($kategori as $kategoris) {
            $kategoris->total_beli = $kategoris->barang->sum(function ($barang) {
                return $barang->harga_beli * $barang->stok;
            });
        }
        $grandTotal = $kategori->sum('total_beli');
        return view('kategori.index', compact('title', 'kategori', 'grandTotal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Kategori::create($request->all());
        return redirect('/kategori')->with('success', 'Data kategori berhasil tersimpan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);
        $kategori->nama = $request->editNama;
        $kategori->save();
        return redirect('/kategori')->with('success', 'Data kategori berhasil terupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
        return redirect('/kategori')->with('success', 'Data kategori berhasil terhapus');
    }
}
