<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCabang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_cabang');
            $table->string('nama_cabang');
            $table->integer('divisi');
            $table->integer('utama');
            $table->string('lat_coord');
            $table->string('long_coord');
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
        Schema::drop("cabang");
    }
}
