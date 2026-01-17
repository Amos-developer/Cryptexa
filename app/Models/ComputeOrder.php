<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ComputeOrder extends Model
{
    protected $fillable = [
        'user_id',
        'compute_plan_id',
        'amount',
        'expected_profit',
        'started_at',
        'ends_at',
        'status',
        'is_paid',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ends_at'    => 'datetime',
        'is_paid'    => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function computePlan()
    {
        return $this->belongsTo(ComputePlan::class);
    }

    /** Progress percentage */
    public function getProgressPercentageAttribute(): int
    {
        if ($this->status === 'completed') {
            return 100;
        }

        $total = $this->ends_at->diffInSeconds($this->started_at);
        $passed = now()->diffInSeconds($this->started_at);

        return min(100, max(0, intval(($passed / $total) * 100)));
    }
}
