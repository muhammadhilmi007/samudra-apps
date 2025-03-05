<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengambilanBarang extends Model
{
    protected $table 		= "pengambilan_barang";
    protected $fillable 	= ['no_pengambilan','kode_pengambilan','pengirim','stt','kendaraan','waktu_berangkat','waktu_pulang','tanggal','cabang','user'];
    protected $primaryKey 	= "id";

    public function s_kendaraan(){
    	return $this->hasOne("\App\Kendaraan", "id", "kendaraan");
    }

    public function s_cabang(){
    	return $this->hasOne("\App\Cabang", "id", "cabang");
    }
}