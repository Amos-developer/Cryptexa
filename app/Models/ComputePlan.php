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

    public function getDurationDaysAttribute(): float
    {
        return round(((float) $this->duration_minutes) / 1440, 4);
    }

    public function getProjectedRoiPercentageAttribute(): float
    {
        $days = $this->duration_days;
        $dailyPercent = (float) $this->daily_profit;

        if ($this->compound_interest) {
            return round((pow(1 + ($dailyPercent / 100), $days) - 1) * 100, 2);
        }

        return round($dailyPercent * $days, 2);
    }

    public function projectedFinalAmount(float $amount): float
    {
        $principal = round($amount, 2);
        $days = $this->duration_days;
        $dailyPercent = (float) $this->daily_profit;

        if ($this->compound_interest) {
            return round($principal * pow(1 + ($dailyPercent / 100), $days), 2);
        }

        return round($principal * (1 + (($dailyPercent / 100) * $days)), 2);
    }

    public function projectedProfit(float $amount): float
    {
        $principal = round($amount, 2);

        return round($this->projectedFinalAmount($principal) - $principal, 2);
    }
}
