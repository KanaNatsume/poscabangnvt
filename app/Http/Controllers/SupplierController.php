<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Supplier';
        $supplier = Supplier::orderBy('id', 'desc')->get();
        return view('supplier.index', compact('title', 'supplier'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Supplier::create($request->all());
        return redirect('/supplier')->with('success', 'Data supplier berhasil tersimpan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);
        $supplier->nama = $request->edit_nama;
        $supplier->no_hp = $request->edit_no_hp;
        $supplier->email = $request->edit_email;
        $supplier->no_rekening = $request->edit_no_rekening;
        $supplier->rekening_atas_nama = $request->edit_rekening_atas_nama;
        $supplier->bank = $request->edit_bank;
        $supplier->kode_pos = $request->edit_kode_pos;
        $supplier->alamat = $request->edit_alamat;
        $supplier->deskripsi = $request->edit_deskripsi;
        $supplier->save();
        return redirect('/supplier')->with('success', 'Data supplier berhasil terupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect('/supplier')->with('success', 'Data supplier berhasil terhapus');
    }
}
