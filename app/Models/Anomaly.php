<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anomaly extends Model
{
    protected $fillable = ['user_id', 'data'];
}
