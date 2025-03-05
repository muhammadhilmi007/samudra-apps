<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class account extends Model
{
    protected $table		="account";
    protected $fillable		=['kode', 'nama_account'];
    protected $primaryKey	= "id";
}