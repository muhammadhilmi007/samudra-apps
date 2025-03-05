<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AntrianTruck extends Model
{
    protected $table 		= "antrian_truck";
    protected $fillable 	= ['truck','supir','no_telp_supir','kernet','no_telp_kernet','cabang'];
    protected $primaryKey 	= "id";


    public function s_truck(){
    	return $this->hasOne("\App\Truck", "id", "truck");
    }

    public function s_muat(){
    	return $this->hasOne("\App\Muat", "antrian_truck", "id")->with("s_stt");
    }

}