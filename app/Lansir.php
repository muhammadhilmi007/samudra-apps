<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lansir extends Model
{
    protected $table 		= "lansir";
    protected $fillable 	= ["antrian_kendaraan","kode_lansir", "checker", "berangkat", "sampai"];
    protected $primaryKey 	= "id";


    public function s_antrian_kendaraan(){
    	return $this->hasOne("\App\AntrianKendaraan", "id", "antrian_kendaraan")->with("s_kendaraan","s_supir","s_kernet","s_lansir");
    }

    public function s_checker(){
    	return $this->hasOne("\App\User", "id", "checker");
    }

    public function s_stt(){
    	return $this->hasMany("\App\LansirDetail", "lansir", "id")->with("s_penjualan");
    }
}
