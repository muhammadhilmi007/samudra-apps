<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table 		= "kendaraan";
    protected $fillable		= ['no_polisi','nama_kendaraan','grup','cabang'];
    protected $primaryKey 	= "id";

    public function s_cabang(){
    	return $this->hasOne("\App\Cabang", "id", "cabang");
    }

}