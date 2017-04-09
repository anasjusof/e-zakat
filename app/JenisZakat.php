<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisZakat extends Model
{
    protected $fillable = [
        'nama_zakat', 'bayaran_zakat', 'tahun'
    ];
}
