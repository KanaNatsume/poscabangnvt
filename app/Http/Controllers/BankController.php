<?php

namespace App\Http\Controllers;

use App\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $title = 'Data Bank';
        $bank = Bank::orderBy('id', 'desc')->get();
        return view('bank.index', compact('title', 'bank'));
    }

    public function store(Request $request)
    {
        Bank::create($request->all());
        return redirect('/bank')->with('success', 'Data Bank berhasil tersimpan');
    }

    public function update(Request $request, $id)
    {
        $bank = Bank::find($id);
        $bank->nama_bank = $request->edit_nama_bank;
        $bank->no_rekening = $request->edit_no_rekening;
        $bank->atas_nama = $request->edit_atas_nama;
        $bank->save();
        return redirect('/bank')->with('success', 'Data Bank berhasil terupdate');
    }

    public function destroy($id)
    {
        $bank = Bank::find($id);
        $bank->delete();
        return redirect('/bank')->with('success', 'Data Bank berhasil terhapus');
    }
}
