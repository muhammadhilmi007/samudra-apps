<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AntrianKendaraan extends Model
{
    protected $table 		= "antrian_kendaraan";
    protected $fillable 	= ["kendaraan","supir", "kernet"];
    protected $primaryKey	= "id";

    public function s_kendaraan(){
    	return $this->hasOne("\App\Kendaraan", "id", "kendaraan")->with("s_cabang");
    }

    public function s_supir(){
    	return $this->hasOne("\App\User", "id", "supir");
    }

    public function s_kernet(){
    	return $this->hasOne("\App\User", "id", "kernet");
    }

    public function s_lansir(){
    	return $this->hasOne("\App\Lansir", "antrian_kendaraan", "id");
    }

}
