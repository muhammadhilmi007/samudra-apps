<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAntrianTruck extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antrian_truck', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('truck');
            $table->string('supir');
            $table->string('no_telp_supir');
            $table->string('kernet');
            $table->string('no_telp_kernet');
            $table->integer('cabang');
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
        Schema::drop("antrian_truck");
    }
}
