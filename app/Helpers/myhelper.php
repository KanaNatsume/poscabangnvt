<?php

use App\Pembelian;
use App\Pengeluaran;
use App\Penjualan;
use App\ReturBarang;
use Carbon\Carbon;

function no_invoice()
{
    $cek_kode_hari_ini = Penjualan::whereDate('created_at', Carbon::today())->count(); // 0
    if ($cek_kode_hari_ini == 0) {
        $kode_penjualan = 'INV' . date('dmy') . '0001';
        return $kode_penjualan;
    } else {
        $get_penjualan = Penjualan::orderBy('id', 'desc')->whereDate('created_at', Carbon::today())->first(); //INV0808210001
        $sub = substr($get_penjualan->no_invoice, 9, 4) + 1; // 0001 + 1 = 0002
        //00010
        $string = sprintf('%04s', $sub); // 0010
        $kode_penjualan = 'INV' . date('dmy') . $string;
        return $kode_penjualan;
    }
}

function no_pembelian()
{
    $cek_no_pembelian_hari_ini = Pembelian::whereDate('created_at', Carbon::today())->count(); // 0
    if ($cek_no_pembelian_hari_ini == 0) {
        $no_pembelian = 'NOP-' . date('dmy') . '0001';
        return $no_pembelian;
    } else {
        $get_penjualan = Pembelian::orderBy('id', 'desc')->whereDate('created_at', Carbon::today())->first(); //NOP-1905210001
        $sub = substr($get_penjualan->no_pembelian, 10, 4) + 1; // 0001 + 1 = 0002
        //00010
        $string = sprintf('%04s', $sub); // 0010
        $no_pembelian = 'NOP-' . date('dmy') . $string;
        return $no_pembelian;
    }
}

function no_pengeluaran()
{
    $cek_no_pengeluaran_hari_ini = Pengeluaran::whereDate('created_at', Carbon::today())->count(); // 0
    if ($cek_no_pengeluaran_hari_ini == 0) {
        $no_pengeluaran = 'NOPE-' . date('dmy') . '0001';
        return $no_pengeluaran;
    } else {
        $get_pengeluaran = Pengeluaran::orderBy('id', 'desc')->whereDate('created_at', Carbon::today())->first(); //NOP-1905210001
        $sub = substr($get_pengeluaran->no_pengeluaran, 11, 4) + 1; // 0001 + 1 = 0002
        //00010
        $string = sprintf('%04s', $sub); // 0010
        $no_pengeluaran = 'NOPE-' . date('dmy') . $string;
        return $no_pengeluaran;
    }
}

function no_retur()
{
    $cek_no_retur_hari_ini = ReturBarang::whereDate('created_at', Carbon::today())->count(); // 0
    if ($cek_no_retur_hari_ini == 0) {
        $no_retur = 'RET-' . date('dmy') . '0001';
        return $no_retur;
    } else {
        $get_retur = ReturBarang::orderBy('id', 'desc')->whereDate('created_at', Carbon::today())->first(); //RET-1905210001
        $sub = substr($get_retur->no_retur, 10, 4) + 1; // 0001 + 1 = 0002
        //00010
        $string = sprintf('%04s', $sub); // 0010
        $no_retur = 'RET-' . date('dmy') . $string;
        return $no_retur;
    }
}

function tanggal_indonesia($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[0] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[2];
}
