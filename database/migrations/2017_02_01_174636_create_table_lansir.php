<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLansir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lansir', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('antrian_kendaraan');
            $table->string('kode_lansir');
            $table->integer('checker');
            $table->dateTime('berangkat');
            $table->dateTime('sampai')->nullable();
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
        Schema::drop('lansir');
    }
}
