<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTukarTambahToPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->boolean('is_tukar_tambah')->default(false);
            $table->string('nama_barang_tukar_tambah')->nullable();
            $table->integer('harga_tukar_tambah')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->dropColumn(['is_tukar_tambah', 'nama_barang_tukar_tambah', 'harga_tukar_tambah']);
        });
    }
}
