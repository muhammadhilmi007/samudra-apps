<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table 		= "penjualan";
    protected $fillable 	= ['stt', 'kantor_asal', 'kantor_tujuan', 'pengirim', 'penerima', 'alamat_penerima', 'penerus', 'kode_penerus', 'nama_barang', 'payment_type', 'jumlah_colly', 'packing', 'berat', 'harga_per_kilo', 'harga_total', 'ket_tambahan', 'kontak_penerima', 'user', 'cabang'];
    protected $primaryKey 	= "id";

    public function s_kantor_asal(){
    	return $this->hasOne("\App\Cabang", "id", "kantor_asal");
    }

    public function s_kantor_tujuan(){
    	return $this->hasOne("\App\Cabang", "id", "kantor_tujuan");
    }

    public function s_user(){
    	return $this->hasOne("\App\User", "id", "user");
    }

    public function s_cabang(){
    	return $this->hasOne("\App\Cabang", "id", "cabang");
    }

    public function s_detail_muat(){
        return $this->hasMany("\App\MuatDetail", "stt", "stt")->with("s_muat");
    }

    public function s_detail_lansir(){
        return $this->hasOne("\App\LansirDetail", "stt", "stt")->with("s_lansir");
    }

    public function s_overdue(){
        return $this->hasOne("\App\Overdue", "stt", "stt");
    }

}