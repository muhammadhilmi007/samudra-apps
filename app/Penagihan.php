<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penagihan extends Model
{
   protected $table ="penagihan";
   protected $fillable =['stt', 'keterangan', 'status'];
   protected $primaryKey='id'; 

   public function s_penjualan(){
   	return $this->hasOne("\App\Penjualan", "stt", "stt");
   }
}

