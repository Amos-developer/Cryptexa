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
        'max_investment',
        'daily_profit',
        'duration_minutes',
        'compound_interest'
    ];
    
    protected $casts = [
        'compound_interest' => 'boolean',
        'price' => 'decimal:2',
        'max_investment' => 'decimal:2',
        'daily_profit' => 'decimal:2',
    ];
}
