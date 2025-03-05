<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JurnalUmum extends Model
{
    protected $table		="jurnal_umum";
    protected $fillable		=['id', 'tanggal', 'account', 'kantor', 'keterangan', 'tambahan', 'debet', 'kredit'];
    protected $primaryKey	= "id";

    public function s_account(){
    	return $this->hasOne("\App\Account", "id", "account");
    }

    public function s_kantor(){
    	return $this->hasOne("\App\Cabang", "id", "kantor");
    }
}
