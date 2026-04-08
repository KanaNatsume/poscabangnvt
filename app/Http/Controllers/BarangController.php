<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Kategori;
use App\StokBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Barang';
        $barang = Barang::orderBy('id', 'desc')->get();
        foreach ($barang as $item) {
            $jumlah_terjual = DB::table('detail_penjualan')
                ->where('kode_barang', $item->kode_barang)
                ->sum('qty');

            $item->jumlah_terjual = $jumlah_terjual;
        }
        return view('barang.index', compact('title', 'barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Barang';
        $kategori = Kategori::all();
        return view('barang.create', compact('title', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'unique:barang',
        ], [
            'kode_barang.unique' => 'Kode barang sudah ada',
        ]);

        $input = $request->all();
        
        // Atur nilai default 0 untuk semua jenis harga multi-tier yang sudah dihapus fiturnya
        $input['harga_grosir'] = 0;
        $input['harga_agen'] = 0;
        $input['harga_custom'] = 0;
        $input['harga_customb'] = 0;
        $input['harga_customc'] = 0;
        $input['harga_customd'] = 0;
        $input['harga_custome'] = 0;
        $input['harga_customf'] = 0;
        $input['harga_customg'] = 0;
        $input['profit_harga_grosir'] = 0;
        $input['profit_harga_agen'] = 0;
        $input['profit_harga_custom'] = 0;
        $input['profit_harga_customb'] = 0;
        $input['profit_harga_customc'] = 0;
        $input['profit_harga_customd'] = 0;
        $input['profit_harga_custome'] = 0;
        $input['profit_harga_customf'] = 0;
        $input['profit_harga_customg'] = 0;

        if ($request->is_jasa == '1') {
            $input['stok'] = 0;
            $input['stok_minimal'] = 0;
        }

        Barang::create($input);
        return redirect('/barang')->with('success', 'Data barang berhasil tersimpan');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Barang';
        $barang = Barang::find($id);
        $kategori = Kategori::all();
        return view('barang.edit', compact('title', 'barang', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);
        if (!$barang) {
            return redirect('/barang')->with('error', 'Barang tidak ditemukan.');
        }

        // Validasi input
        $request->validate([
            'kode_barang' => 'required|unique:barang,kode_barang,' . $barang->id,
        ], [
            'kode_barang.required' => 'Kode barang harus diisi',
            'kode_barang.unique' => 'Kode barang sudah ada',
        ]);

        // Mengupdate atribut-atribut barang
        $barang->kode_barang = $request->kode_barang;
        $barang->kategori_id = $request->kategori_id;
        $barang->nama_barang = $request->nama_barang;
        $barang->harga_beli = $request->harga_beli;
        $barang->harga_ecer = $request->harga_ecer;
        $barang->profit_harga_ecer = $request->profit_harga_ecer;
        
        // Jenis Harga lain di nonaktifkan: force set to 0
        $barang->harga_grosir = 0;
        $barang->harga_agen = 0;
        $barang->harga_custom = 0;
        $barang->harga_customb = 0;
        $barang->harga_customc = 0;
        $barang->harga_customd = 0;
        $barang->harga_custome = 0;
        $barang->harga_customf = 0;
        $barang->harga_customg = 0;
        $barang->profit_harga_grosir = 0;
        $barang->profit_harga_agen = 0;
        $barang->profit_harga_custom = 0;
        $barang->profit_harga_customb = 0;
        $barang->profit_harga_customc = 0;
        $barang->profit_harga_customd = 0;
        $barang->profit_harga_custome = 0;
        $barang->profit_harga_customf = 0;
        $barang->profit_harga_customg = 0;

        $barang->deskripsi = $request->deskripsi;
        $barang->is_jasa = $request->is_jasa;

        if ($request->is_jasa == '1') {
            $barang->stok = 0;
            $barang->stok_minimal = 0;
        } else {
            $barang->stok = $request->stok;
            $barang->stok_minimal = $request->stok_minimal;
        }

        // Simpan perubahan


        // Simpan perubahan
        $barang->save();

        return redirect('/barang')->with('success', 'Data barang berhasil terupdate');

        // baru
        // $barang = Barang::find($id);
        // if (!$barang) {
        //     return redirect('/barang')->with('error', 'Barang tidak ditemukan.');
        // }

        // // Validasi input
        // $request->validate([
        //     'kode_barang' => 'required|unique:barang,kode_barang,' . $barang->id,
        //     'gambar_barang' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        // ], [
        //     'kode_barang.required' => 'Kode barang harus diisi',
        //     'kode_barang.unique' => 'Kode barang sudah ada',
        //     'gambar_barang.image' => 'Gambar harus berupa file gambar',
        //     'gambar_barang.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
        //     'gambar_barang.max' => 'Ukuran gambar tidak boleh lebih dari 2MB'
        // ]);

        // // Update data barang
        // $barang->fill($request->except('gambar_barang'));

        // // Proses gambar jika ada
        // if ($request->hasFile('gambar_barang')) {
        //     if ($barang->gambar_barang && file_exists(public_path('photo/' . $barang->gambar_barang))) {
        //         unlink(public_path('photo/' . $barang->gambar_barang));
        //     }

        //     $gambar_barang = $request->file('gambar_barang');
        //     $ubah_nama_gambar_barang = time() . '_' . $gambar_barang->getClientOriginalName();
        //     $gambar_barang->move(public_path('photo'), $ubah_nama_gambar_barang);

        //     $barang->gambar_barang = $ubah_nama_gambar_barang;
        // }

        // $barang->save();

        // return redirect('/barang')->with('success', 'Data barang berhasil terupdate');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();
        return redirect('/barang')->with('success', 'Data barang berhaszil terhapus');
    }
}
