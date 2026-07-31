<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PengaturanAbsensi;

class PengaturanAbsensiController extends Controller
{
    public function index()
    {
        $title = 'Pengaturan Lokasi Absen';
        $pengaturan = PengaturanAbsensi::first();
        if (!$pengaturan) {
            $pengaturan = new PengaturanAbsensi();
        }
        return view('absensi.pengaturan', compact('title', 'pengaturan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            'radius' => 'required|numeric'
        ]);

        $pengaturan = PengaturanAbsensi::first();
        if (!$pengaturan) {
            PengaturanAbsensi::create($request->all());
        } else {
            $pengaturan->update($request->all());
        }

        return redirect('/pengaturan-absensi')->with('success', 'Pengaturan lokasi berhasil disimpan!');
    }
}
