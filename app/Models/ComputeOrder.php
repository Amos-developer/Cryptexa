<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ComputePlan;
use App\Models\User;

class ComputeOrder extends Model
{
    // Fields
    protected $fillable = [
        'user_id',
        'compute_plan_id',
        'amount',
        'expected_profit',
        'started_at',
        'ends_at',
        'status'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ends_at' => 'datetime',
    ];


    protected $dates = ['started_at', 'ends_at'];

    /**
     * Each order belongs to a compute plan
     */
    public function computePlan()
    {
        return $this->belongsTo(ComputePlan::class, 'compute_plan_id');
    }

 
    public function isCompleted()
    {
        return now()->greaterThanOrEqualTo($this->ends_at);
    }

    public function plan()
    {
        return $this->belongsTo(
            \App\Models\ComputePlan::class,
            'compute_plan_id'
        );
    }


    /**
     * Each order belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
