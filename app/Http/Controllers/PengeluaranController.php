<?php

namespace App\Http\Controllers;

use App\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Pencatatan Keuangan';
        
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        $pengeluaranRaw = Pengeluaran::whereMonth('tanggal', $bulan)
                            ->whereYear('tanggal', $tahun)
                            ->orderBy('tanggal', 'desc')
                            ->orderBy('id', 'asc')
                            ->get();

        $grouped = [];
        $total_pemasukan_bulan = 0;
        $total_pengeluaran_bulan = 0;

        foreach ($pengeluaranRaw as $item) {
            $tgl = $item->tanggal ? date('Y-m-d', strtotime($item->tanggal)) : date('Y-m-d', strtotime($item->created_at));
            if (!isset($grouped[$tgl])) {
                $grouped[$tgl] = ['pemasukan' => [], 'pengeluaran' => []];
            }
            if ($item->jenis == 'Pemasukan') {
                $grouped[$tgl]['pemasukan'][] = $item;
                $total_pemasukan_bulan += $item->jumlah;
            } else {
                $grouped[$tgl]['pengeluaran'][] = $item;
                $total_pengeluaran_bulan += $item->jumlah;
            }
        }
        
        krsort($grouped);

        // Kategori Summary (optional but nice to keep)
        $kategori_list = ['Toko','Kesra','Penjualan','Pembelian','Service','A Kevin','Kantor','Sisa'];
        $total_per_kategori = [];
        foreach ($kategori_list as $kat) {
            $pemasukan = Pengeluaran::where('kategori_pengeluaran', $kat)->where('jenis', 'Pemasukan')->sum('jumlah');
            $pengeluaran_jml = Pengeluaran::where('kategori_pengeluaran', $kat)->where('jenis', 'Pengeluaran')->sum('jumlah');
            $total_per_kategori[$kat] = $pemasukan - $pengeluaran_jml;
        }

        return view('pengeluaran.index', compact('title', 'grouped', 'bulan', 'tahun', 'total_pemasukan_bulan', 'total_pengeluaran_bulan', 'total_per_kategori', 'kategori_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($no_pengeluaran)
    {
        $title = 'Pencatatan Keuangan';
        return view('pengeluaran.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Pengeluaran::create($request->all());
        return redirect('/pengeluaran')->with('success', 'Data pencatatan keuangan berhasil tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengeluaran $pengeluaran)
    {
        $title = 'Pencatatan Keuangan';
        return view('pengeluaran.edit', compact('title', 'pengeluaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $pengeluaran->no_pengeluaran = $request->no_pengeluaran;
        $pengeluaran->jenis = $request->jenis;
        $pengeluaran->tanggal = $request->tanggal;
        $pengeluaran->nama = $request->nama;
        $pengeluaran->jumlah = $request->jumlah;
        $pengeluaran->keterangan = $request->keterangan;
        $pengeluaran->kategori_pengeluaran = $request->kategori_pengeluaran;
        $pengeluaran->save();
        return redirect('/pengeluaran')->with('success', 'Data pencatatan keuangan berhasil terupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();
        return redirect('/pengeluaran')->with('success', 'Data pencatatan keuangan berhasil terhapus');
    }
}
