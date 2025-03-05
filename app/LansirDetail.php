<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LansirDetail extends Model
{
    protected $table 		= "lansir_detail";
    protected $fillable 	= ["stt", "lansir", "nama_penerima", "status", "keterangan"];
    protected $primaryKey 	= "id";


    public function s_penjualan(){
    	return $this->hasOne("\App\Penjualan", "stt", "stt")->with("s_kantor_asal","s_kantor_tujuan", "s_user", "s_cabang");
    }

    public function s_lansir(){
    	return $this->hasOne("\App\Lansir", "id", "lansir")->with("s_antrian_kendaraan");
    }

}
