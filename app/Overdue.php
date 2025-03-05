<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Overdue extends Model
{
    protected $table 		= "overdue";
    protected $fillable 	= ['stt','cabang','pelanggan','nominal_awal','nominal'];
    protected $primaryKey 	= "id";



    public function s_stt(){
    	return $this->hasOne("\App\Penjualan", "stt", "stt");
    }

    public function s_cabang(){
    	return $this->hasOne("\App\Cabang", "id", "cabang");
    }

}
