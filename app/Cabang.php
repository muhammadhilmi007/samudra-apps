<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    protected $table 		= "cabang";
    protected $fillable 	= ["kode_cabang", "nama_cabang", "divisi", "utama"];
    protected $primaryKey	= "id";

    public function s_divisi(){
    	return $this->hasOne("\App\Divisi", "id", "divisi");
    }
}
