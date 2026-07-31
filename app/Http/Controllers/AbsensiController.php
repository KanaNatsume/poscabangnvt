<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absensi;
use App\PengaturanAbsensi;
use App\User;
use Carbon\Carbon;
use Auth;

class AbsensiController extends Controller
{
    public function index()
    {
        $title = 'Data Absensi Harian';
        // Ambil data hari ini default
        $tanggal = request('tanggal') ?? date('Y-m-d');
        
        $absensi = Absensi::with('user')
            ->whereDate('tanggal', $tanggal)
            ->orderBy('jam_masuk', 'desc')
            ->get();
            
        $users = User::whereIn('role', ['kasir', 'karyawan'])->get();
            
        return view('absensi.admin_index', compact('title', 'absensi', 'tanggal', 'users'));
    }

    public function admin_store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'tanggal' => 'required|date',
            'status' => 'required',
        ]);

        Absensi::create([
            'user_id' => $request->user_id,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'status' => $request->status,
            'keterangan' => $request->keterangan
        ]);

        return back()->with('success', 'Data absensi berhasil ditambahkan.');
    }

    public function admin_update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'tanggal' => 'required|date',
            'status' => 'required',
        ]);

        $absen = Absensi::findOrFail($id);
        $absen->update([
            'user_id' => $request->user_id,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'status' => $request->status,
            'keterangan' => $request->keterangan
        ]);

        return back()->with('success', 'Data absensi berhasil diperbarui.');
    }

    public function admin_destroy($id)
    {
        $absen = Absensi::findOrFail($id);
        $absen->delete();

        return back()->with('success', 'Data absensi berhasil dihapus.');
    }

    public function karyawan()
    {
        $title = 'Absensi Kehadiran';
        $today = date('Y-m-d');
        
        // Cek absensi hari ini
        $absen_hari_ini = Absensi::where('user_id', Auth::id())
            ->whereDate('tanggal', $today)
            ->first();
            
        $pengaturan = PengaturanAbsensi::first();
        if (!$pengaturan || empty($pengaturan->latitude) || empty($pengaturan->longitude)) {
            return view('absensi.karyawan')->with('error_lokasi', 'Admin belum mengatur titik lokasi toko. Absensi tidak dapat dilakukan.');
        }

        return view('absensi.karyawan', compact('title', 'absen_hari_ini', 'pengaturan'));
    }

    public function absen(Request $request)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $pengaturan = PengaturanAbsensi::first();
        if (!$pengaturan) {
            return back()->with('error', 'Pengaturan lokasi belum diatur admin.');
        }

        // Hitung jarak (Haversine formula)
        $distance = $this->haversineGreatCircleDistance(
            $request->latitude, 
            $request->longitude, 
            $pengaturan->latitude, 
            $pengaturan->longitude
        );

        if ($distance > $pengaturan->radius) {
            return back()->with('error', 'Anda berada di luar jangkauan lokasi toko (' . round($distance) . ' meter dari toko). Batas maksimal: ' . $pengaturan->radius . ' meter.');
        }

        $today = date('Y-m-d');
        $now = date('H:i:s');
        $latLong = $request->latitude . ',' . $request->longitude;

        $absen = Absensi::where('user_id', Auth::id())
            ->whereDate('tanggal', $today)
            ->first();

        if (!$absen) {
            // Absen Masuk
            Absensi::create([
                'user_id' => Auth::id(),
                'tanggal' => $today,
                'jam_masuk' => $now,
                'lat_long_masuk' => $latLong,
                'status' => 'hadir'
            ]);
            return back()->with('success', 'Berhasil melakukan Absen Masuk!');
        } else if (empty($absen->jam_pulang)) {
            // Absen Pulang
            $absen->update([
                'jam_pulang' => $now,
                'lat_long_pulang' => $latLong
            ]);
            return back()->with('success', 'Berhasil melakukan Absen Pulang! Selamat beristirahat.');
        } else {
            return back()->with('error', 'Anda sudah melakukan absen masuk dan pulang hari ini.');
        }
    }

    /**
     * Calculates the great-circle distance between two points, with
     * the Haversine formula.
     * @return float Distance in meters
     */
    private function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
    {
        $earthRadius = 6371000; // in meters
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        
        return $angle * $earthRadius;
    }
}
