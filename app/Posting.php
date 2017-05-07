<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posting extends Model
{
	use SoftDeletes;

    protected $fillable = [
    	'pelanggaran',
    	'jenis_kendaraan',
    	'plat_nomor',
    	'lastImage'
    ];

    protected $dates = ['deleted_at'];
}
