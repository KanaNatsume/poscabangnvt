<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/tes_autocomplete', 'DashboardController@tes_autocomplete');
Route::post('/ambil_data_barang', 'PenjualanController@ambil_data_barang');

Route::get('/', 'LoginController@index')->name('login')->middleware('guest');
Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');

Route::group(['middleware' => ['auth', 'check.role:admin']], function () {
    Route::get('/supplier', 'SupplierController@index');
    Route::post('/supplier', 'SupplierController@store');
    Route::post('/supplier/{id}/update', 'SupplierController@update');
    Route::get('/supplier/{id}/destroy', 'SupplierController@destroy');

    Route::get('/kategori', 'KategoriController@index');
    Route::post('/kategori', 'KategoriController@store');
    Route::post('/kategori/{id}/update', 'KategoriController@update');
    Route::get('/kategori/{id}/destroy', 'KategoriController@destroy');


    Route::get('/barang', 'BarangController@index');
    Route::get('/barang/create', 'BarangController@create');
    Route::post('/barang', 'BarangController@store');
    Route::get('/barang/{id}/edit', 'BarangController@edit');
    Route::put('/barang/update/{id}', 'BarangController@update');
    Route::get('/barang/{id}/destroy', 'BarangController@destroy');

    Route::get('/transfer', 'TransferController@index');
    Route::get('/transfer/create', 'TransferController@create');
    Route::post('/transfer', 'TransferController@store');
    Route::get('/transfer/{id}/edit', 'TransferController@edit');
    Route::put('/transfer/update/{id}', 'TransferController@update');
    Route::get('/transfer/{id}/destroy', 'TransferController@destroy');

    Route::get('/pelanggan', 'PelangganController@index');
    Route::post('/pelanggan', 'PelangganController@store');
    Route::post('/pelanggan/ajax', 'PelangganController@storeAjax');
    Route::post('/pelanggan/{id}/update', 'PelangganController@update');
    Route::get('/pelanggan/{id}/destroy', 'PelangganController@destroy');

    Route::get('/user', 'UserController@index');
    Route::post('/user', 'UserController@store');
    Route::post('/user/{id}/update', 'UserController@update');
    Route::get('/user/{id}/destroy', 'UserController@destroy');

    Route::get('/bank', 'BankController@index');
    Route::post('/bank', 'BankController@store');
    Route::post('/bank/{id}/update', 'BankController@update');
    Route::get('/bank/{id}/destroy', 'BankController@destroy');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/dashboard/penjualan', 'DashboardController@penjualan');
    Route::get('/dashboard/profit', 'DashboardController@profit');
    Route::get('/dashboard/supplier', 'DashboardController@supplier');
    Route::get('/dashboard/barang', 'DashboardController@barang');
    Route::get('/dashboard/chart', 'DashboardController@chart');

    Route::get('/profile', 'UserController@profile');
    Route::post('/profile', 'UserController@update_profile');
    Route::post('/updatepassword', 'UserController@update_password');
    Route::get('/pelanggan', 'PelangganController@index');
    Route::post('/pelanggan', 'PelangganController@store');
    Route::post('/pelanggan/ajax', 'PelangganController@storeAjax');
    Route::post('/pelanggan/{id}/update', 'PelangganController@update');
    Route::get('/pelanggan/{id}/destroy', 'PelangganController@destroy');

    Route::get('/penjualan/{no_invoice}', 'PenjualanController@index');
    Route::get('/penjualan/tambah/{no_invoice}', 'PenjualanController@create');
    Route::post('/penjualan', 'PenjualanController@store');
    Route::post('/penjualan/detail_penjualan', 'PenjualanController@detail_penjualan');
    Route::get('/penjualan/{id}/destroy', 'PenjualanController@destroy');
    Route::get('/penjualan/struk/{id}', 'PenjualanController@struk');
    Route::get('/penjualan/pdf/{id}', 'PenjualanController@downloadPDF');

    Route::get('/hutang', 'HutangController@index');
    Route::get('/hutang/detail/{id}', 'HutangController@detail');
    Route::get('/hutang/{id}/edit', 'HutangController@edit');
    Route::post('/hutang/update/{id}', 'HutangController@update');
    Route::get('/hutang/detail/download/{id}', 'HutangController@download');

    Route::get('/retur', 'ReturBarangController@index');
    Route::get('/retur/tambah/{no_retur}', 'ReturBarangController@create');
    Route::post('/retur', 'ReturBarangController@store');
    Route::post('/retur/detail_retur_barang', 'ReturBarangController@detail_retur_barang');
    Route::get('/retur/detail/{id}', 'ReturBarangController@detail');
    Route::get('/retur/detail/download/{id}', 'ReturBarangController@download');
    Route::get('/retur/{id}/hapus_detail_retur_barang', 'ReturBarangController@hapus_detail_retur_barang');

    Route::get('/pengeluaran', 'PengeluaranController@index');
    Route::get('/pengeluaran/tambah/{no_pengeluaran}', 'PengeluaranController@create');
    Route::post('/pengeluaran', 'PengeluaranController@store');
    Route::get('/pengeluaran/edit/{pengeluaran}', 'PengeluaranController@edit');
    Route::post('/pengeluaran/update/{pengeluaran}', 'PengeluaranController@update');
    Route::get('/pengeluaran/hapus/{pengeluaran}', 'PengeluaranController@destroy');

    Route::get('/laporan/pembelian', 'LaporanController@pembelian');
    Route::get('/laporan/pembelian/semua', 'LaporanController@pembelian_semua');
    Route::get('/laporan/pembelian/semua/download', 'LaporanController@pembelian_semua_download');
    Route::get('/laporan/pembelian/pertanggal', 'LaporanController@pembelian_pertanggal');
    Route::get('/laporan/pembelian/pertanggal/download', 'LaporanController@pembelian_pertanggal_download');


    Route::get('/laporan/penjualan_harian', 'LaporanController@penjualan_harian');
    Route::get('/laporan/penjualan_harian_cari', 'LaporanController@penjualan_harian_cari');
    Route::post('/laporan/penjualan_harian_download', 'LaporanController@penjualan_harian_download');
    Route::get('/laporan/detail_penjualan/{no_invoice}', 'LaporanController@detail_penjualan');
    Route::get('/laporan/detail_penjualan_download/{no_invoice}', 'LaporanController@detail_penjualan_download');

    Route::get('/laporan/penjualan_minggu_atau_bulan', 'LaporanController@penjualan_minggu_atau_bulan');
    Route::get('/laporan/penjualan_minggu_atau_bulan_cari', 'LaporanController@penjualan_minggu_atau_bulan_cari');
    Route::post('/laporan/penjualan_minggu_atau_bulan_download', 'LaporanController@penjualan_minggu_atau_bulan_download');

    Route::get('/laporan/keuntungan_harian', 'LaporanController@keuntungan_harian');
    Route::get('/laporan/keuntungan_harian_cari', 'LaporanController@keuntungan_harian_cari');
    Route::post('/laporan/keuntungan_harian_download', 'LaporanController@keuntungan_harian_download');

    Route::get('/laporan/keuntungan_minggu_atau_bulan', 'LaporanController@keuntungan_minggu_atau_bulan');
    Route::get('/laporan/keuntungan_minggu_atau_bulan_cari', 'LaporanController@keuntungan_minggu_atau_bulan_cari');
    Route::post('/laporan/keuntungan_minggu_atau_bulan_download', 'LaporanController@keuntungan_minggu_atau_bulan_download');

    Route::get('/laporan/produk_terjual', 'LaporanController@produk_terjual');
    Route::get('/laporan/produk_terjual_cari', 'LaporanController@produk_terjual_cari');
    Route::get('/laporan/produk_terjual_download', 'LaporanController@produk_terjual_download');


    Route::get('/laporan/retur', 'LaporanController@retur');
    Route::get('/laporan/retur/semua', 'LaporanController@retur_semua');
    Route::get('/laporan/retur/semua/download', 'LaporanController@retur_semua_download');
    Route::get('/laporan/retur/pertanggal', 'LaporanController@retur_pertanggal');
    Route::get('/laporan/retur/pertanggal/download', 'LaporanController@retur_pertanggal_download');

    Route::get('/laporan/hutang', 'LaporanController@hutang');
    Route::get('/laporan/hutang/semua', 'LaporanController@hutang_semua');
    Route::get('/laporan/hutang/semua/download', 'LaporanController@hutang_semua_download');
    Route::get('/laporan/hutang/pertanggal', 'LaporanController@hutang_pertanggal');
    Route::get('/laporan/hutang/pertanggal/download', 'LaporanController@hutang_pertanggal_download');

    Route::get('/laporan/pengeluaran', 'LaporanController@pengeluaran');
    Route::get('/laporan/pengeluaran/semua', 'LaporanController@pengeluaran_semua');
    Route::get('/laporan/pengeluaran/semua/download', 'LaporanController@pengeluaran_semua_download');
    Route::get('/laporan/pengeluaran/pertanggal', 'LaporanController@pengeluaran_pertanggal');
    Route::get('/laporan/pengeluaran/pertanggal/download', 'LaporanController@pengeluaran_pertanggal_download');

    Route::get('/laporan/keuangan', 'LaporanController@keuangan');
    Route::get('/laporan/keuangan_cari', 'LaporanController@keuangan_cari');
    Route::post('/laporan/keuangan_download', 'LaporanController@keuangan_download');

    Route::get('/laporan/stok_barang', 'LaporanController@stok_barang');
    Route::get('/laporan/stok_barang_download_pdf', 'LaporanController@stok_barang_download_pdf');

    Route::get('/pembelian', 'PembelianController@index');
    Route::get('/pembelian/create/{no_pembelian}', 'PembelianController@create');
    Route::post('/pembelian', 'PembelianController@store');
    Route::get('/pembelian/{id}/edit', 'PembelianController@edit');
    Route::put('/pembelian/update/{id}', 'PembelianController@update');
    Route::get('/pembelian/{id}/destroy', 'PembelianController@destroy');
    Route::post('/pembelian/simpan_detail_pembayaran', 'PembelianController@simpan_detail_pembayaran');
    Route::get('/pembelian/detail/{no_pembelian}', 'PembelianController@detail');
    Route::get('/pembelian/detail/edit/{no_pembelian}/{id}', 'PembelianController@edit_pembelian');
    Route::put('/pembelian/detail/update/{id}', 'PembelianController@update_pembelian');
    Route::get('/pembelian/detail/download/{no_pembelian}', 'PembelianController@download');

    Route::get('/keluar', 'KeluarController@index');
});
