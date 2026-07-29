<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_id');
            $table->foreign('kategori_id')->references('id')->on('kategori');
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->string('link');
            $table->integer('berat_barang');
            $table->date('jatuh_tempo');
            $table->integer('harga_modal');
            $table->integer('harga_modal_satuan');
            $table->integer('modal_isi_pcs');
            $table->integer('harga_ecer');
            $table->integer('harga_ecer_persentase');
            $table->integer('harga_ecer_profit');
            $table->integer('ecer_isi_pcs');
            $table->integer('harga_grosir');
            $table->integer('harga_grosir_persentase');
            $table->integer('harga_grosir_profit');
            $table->integer('grosir_isi_pcs');
            $table->integer('harga_agen');
            $table->integer('harga_agen_persentase');
            $table->integer('harga_agen_profit');
            $table->integer('agen_isi_pcs');
            $table->integer('jumlah_stok');
            $table->integer('minimal_stok');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
