<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    //
    protected $fillable = [
        'currency',

    ];
    protected $hidden = ['created_at', 'updated_at',];
}
