<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Muat extends Model
{
    protected $table 		= "muat";
    protected $fillable		= ['id','antrian_truck','kode_muat','cabang',"cabang_tujuan",'waktu_berangkat','sampai','checker'];
    protected $primaryKey	= "id";


    public function s_antrian_truck(){
    	return $this->hasOne("\App\AntrianTruck", "id", "antrian_truck")->with("s_truck");
    }

    public function s_stt(){
    	return $this->hasMany("\App\MuatDetail", "id_muat", "id")->with("s_penjualan");
    }

    public function s_cabang(){
        return $this->hasOne("\App\Cabang", "id", "cabang");
    }

    public function s_cabang_tujuan(){
        return $this->hasOne("\App\Cabang", "id", "cabang_tujuan");
    }

    public function s_checker(){
    	return $this->hasOne("\App\User", "id", "checker");
    }
}