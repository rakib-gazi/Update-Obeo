<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    //
    protected  $fillable = ['payment'];
    protected $hidden = ['created_at', 'updated_at',];
}
