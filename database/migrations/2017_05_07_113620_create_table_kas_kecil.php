<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKasKecil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kas_kecil', function(Blueprint $table){
            $table->increments('id');
            $table->string('tanggal')->nullable();
            $table->string('account')->nullable();
            $table->integer('kantor')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('tambahan')->nullable();
            $table->string('debet')->nullable();
            $table->string('kredit')->nullable();
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
        Schema::drop('kas_kecil');
    }
}
