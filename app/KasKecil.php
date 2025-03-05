<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KasKecil extends Model
{
    protected $table		="kas_kecil";
    protected $fillable		=['id', 'tanggal', 'account', 'kantor', 'keterangan', 'tambahan', 'debet', 'kredit'];
    protected $primaryKey	= "id";

    public function s_account(){
    	return $this->hasOne("\App\Account", "kode", "account");
    }
    public function s_kantor(){
    	return $this->hasOne("\App\Cabang", "id", "kantor");
    }
}
