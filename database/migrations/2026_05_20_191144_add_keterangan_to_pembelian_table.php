<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKeteranganToPembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('pembelian', 'keterangan')) {
            Schema::table('pembelian', function (Blueprint $table) {
                $table->text('keterangan')->nullable()->after('total_harga');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('pembelian', 'keterangan')) {
            Schema::table('pembelian', function (Blueprint $table) {
                $table->dropColumn('keterangan');
            });
        }
    }
}
