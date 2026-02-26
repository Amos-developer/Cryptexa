<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComputePlan extends Model
{
    //Fields
    protected $fillable = [
        'name',
        'type',
        'price',
        'daily_profit',
        'duration_minutes'
    ];
    
}
