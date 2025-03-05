<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReqPengambilanBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('req_pengambilan_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pengirim');
            $table->string('penerima');
            $table->text('alamat_pengambilan');
            $table->text('tujuan');
            $table->integer('jumlah_colly');
            $table->integer('cabang');
            $table->string('status');
            $table->date('tanggal');
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
        Schema::drop('req_pengambilan_barang');
    }
}
