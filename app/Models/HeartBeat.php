<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeartBeat extends Model
{
    protected $fillable = ['data', 'user_id'];
}
