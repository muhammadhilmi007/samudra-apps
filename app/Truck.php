<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    protected $table 		= "truck";
    protected $fillable		= ['no_polisi','nama_truck','grup','cabang'];
    protected $primaryKey 	= "id";

    public function s_cabang(){
    	return $this->hasOne("\App\Cabang", "id", "cabang");
    }

}
