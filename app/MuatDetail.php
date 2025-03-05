<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MuatDetail extends Model
{
    protected $table 		= "muat_detail";
    protected $fillable 	= ["stt", "id_muat", "status", "keterangan"];
    protected $primaryKey 	= "id";

    public function s_penjualan(){
    	return $this->hasOne("\App\Penjualan", "stt", "stt")->with("s_kantor_asal","s_kantor_tujuan", "s_user", "s_cabang");
    }

    public function s_muat(){
    	return $this->hasOne("\App\Muat", "id", "id_muat")->with("s_checker");
    }
}
