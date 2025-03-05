<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OverdueDetail extends Model
{
    protected $table 		= "overdue_detail";
    protected $fillable 	= ["stt", "tanggal", "besar_nominal"];
    protected $primaryKey	= "id";
}
