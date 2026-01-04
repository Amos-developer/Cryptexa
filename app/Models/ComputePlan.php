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
        'min_profit',
        'max_profit',
        'duration_minutes'
    ];
}
