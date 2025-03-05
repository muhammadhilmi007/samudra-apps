<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMuat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('muat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_muat');
            $table->integer('cabang');
            $table->integer('cabang_tujuan');
            $table->integer('antrian_truck');
            $table->dateTime('waktu_berangkat');
            $table->dateTime('sampai')->nullable();
            $table->integer('checker');
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
        Schema::drop('muat');
    }
}
