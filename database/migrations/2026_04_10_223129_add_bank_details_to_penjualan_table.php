<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBankDetailsToPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->unsignedBigInteger('bank_id')->nullable()->after('jenis_bank');
            $table->string('bank_nama')->nullable()->after('bank_id');
            $table->string('bank_rekening')->nullable()->after('bank_nama');
            $table->string('bank_atas_nama')->nullable()->after('bank_rekening');
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
            $table->dropColumn(['bank_id', 'bank_nama', 'bank_rekening', 'bank_atas_nama']);
        });
    }
}
