<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posting extends Model
{
    protected $fillable = [
    	'pelanggaran',
    	'jenis_kendaraan',
    	'plat_nomor',
    	'lastImage'
    ];
}
