<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReqPengambilanBarang extends Model
{
    protected $table 		= "req_pengambilan_barang";
    protected $fillable 	= ['pengirim', 'penerima', 'alamat_pengambilan', 'tujuan', 'jumlah_colly', 'cabang', 'status', 'user']; 
    protected $primaryKey 	= "id";

    public function s_cabang(){
    	return $this->hasOne("\App\Cabang", "id", "cabang");
    }

 }