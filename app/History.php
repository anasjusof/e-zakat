<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'users_id', 'zakats_id', 'receipts_id', 'status'
    ];
}
