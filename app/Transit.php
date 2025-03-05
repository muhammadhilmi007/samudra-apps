<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transit extends Model
{
    protected $table 		= "transit";
    protected $primaryKey 	= "id";
    protected $fillable 	= ["penjualan", "transit"];

}
