<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Absensi;
use Carbon\Carbon;

class PenggajianController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Laporan Penggajian Karyawan';
        
        // Default ke bulan dan tahun sekarang
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        // Tentukan periode: Tgl 23 bulan lalu s/d Tgl 22 bulan ini
        // Jika bulan yang dipilih adalah Januari (01), maka bulan lalu adalah Desember (12) tahun sebelumnya
        $start_date = Carbon::createFromDate($tahun, $bulan, 22)->subMonth()->day(23)->format('Y-m-d');
        $end_date = Carbon::createFromDate($tahun, $bulan, 22)->format('Y-m-d');
        
        // Hitung total hari dalam periode ini
        $total_hari_periode = Carbon::parse($start_date)->diffInDays(Carbon::parse($end_date)) + 1;

        // Ambil semua user kecuali admin (atau khusus karyawan dan kasir)
        $users = User::whereIn('role', ['karyawan', 'kasir'])->get();

        $data_penggajian = [];

        foreach ($users as $user) {
            // Hitung jumlah kehadiran
            $hadir = Absensi::where('user_id', $user->id)
                ->where('status', 'hadir')
                ->whereBetween('tanggal', [$start_date, $end_date])
                ->count();

            // Asumsi tidak hadir = libur/alpa
            $libur = $total_hari_periode - $hadir;
            if ($libur < 0) $libur = 0; // Jaga-jaga jika lebih absen dari total hari

            $gaji_pokok = $user->gaji_pokok ?? 0;
            $potongan = 0;
            $kelebihan_libur = 0;

            // Maksimal libur 3 hari
            if ($libur > 3) {
                $kelebihan_libur = $libur - 3;
                $potongan_per_hari = $gaji_pokok / 30; // Rumus: Gaji per 30 hari
                $potongan = $kelebihan_libur * $potongan_per_hari;
            }

            $gaji_bersih = $gaji_pokok - $potongan;

            $data_penggajian[] = [
                'user' => $user,
                'hadir' => $hadir,
                'libur' => $libur,
                'kelebihan_libur' => $kelebihan_libur,
                'gaji_pokok' => $gaji_pokok,
                'potongan' => $potongan,
                'gaji_bersih' => $gaji_bersih
            ];
        }

        return view('absensi.penggajian', compact(
            'title', 'bulan', 'tahun', 'start_date', 'end_date', 'total_hari_periode', 'data_penggajian'
        ));
    }
}
