<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePengambilanBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengambilan_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_pengambilan');
            $table->string('kode_pengambilan');
            $table->string('pengirim');
            $table->string('stt');
            $table->integer('kendaraan');
            $table->string('waktu_berangkat');
            $table->string('waktu_pulang');
            $table->date('tanggal');
            $table->integer('cabang');
            $table->integer('user');
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
        Schema::drop("pengambilan_barang");
    }
}
