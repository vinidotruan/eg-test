<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodPressure extends Model
{
    protected $fillable = ['systolic', 'diastolic', 'user_id'];
}
