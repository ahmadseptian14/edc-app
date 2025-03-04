<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanBarusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_barus', function (Blueprint $table) {
            $table->id();
            $table->string('cabang')->nullable();
            $table->string('unit')->nullable();
            $table->string('nama_ppbk')->nullable();
            $table->integer('kode_outlet')->nullable();
            $table->string('nama_outlet_baru')->nullable();
            $table->string('sn')->nullable();
            $table->string('merk_mesin')->nullable();
            $table->string('no_simcard')->nullable();
            $table->string('keterangan_stok_mesin')->nullable();
            $table->string('merk_simcard')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('pic')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('pengajuan_barus');
    }
}
