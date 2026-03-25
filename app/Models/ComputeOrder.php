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
        'investment_amount',
        'expected_profit',
        'daily_profit_percent',
        'last_compound_at',
        'started_at',
        'ends_at',
        'status',
        'is_paid',
        'balance_before',
        'balance_after',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ends_at'    => 'datetime',
        'last_compound_at' => 'datetime',
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

    public function getPrincipalAmountAttribute(): float
    {
        return round((float) ($this->investment_amount ?? $this->amount ?? 0), 2);
    }

    public function getTotalReturnAttribute(): float
    {
        return round($this->principal_amount + (float) $this->expected_profit, 2);
    }

    public function getElapsedProfitDaysAttribute(): int
    {
        $this->loadMissing('computePlan');

        if (!$this->started_at || !$this->computePlan) {
            return 0;
        }

        $totalDays = max(0, (int) floor(((float) $this->computePlan->duration_minutes) / 1440));
        $elapsedDays = max(0, $this->started_at->diffInDays(min(now(), $this->ends_at ?? now())));

        return min($elapsedDays, $totalDays);
    }

    public function getCurrentAccruedValueAttribute(): float
    {
        $this->loadMissing('computePlan');

        if (!$this->computePlan) {
            return $this->principal_amount;
        }

        $principal = $this->principal_amount;
        $dailyPercent = (float) ($this->daily_profit_percent ?? $this->computePlan->daily_profit ?? 0);
        $elapsedDays = $this->elapsed_profit_days;

        if ($this->computePlan->compound_interest) {
            return round($principal * pow(1 + ($dailyPercent / 100), $elapsedDays), 2);
        }

        return round($principal * (1 + (($dailyPercent / 100) * $elapsedDays)), 2);
    }

    public function getCurrentAccruedProfitAttribute(): float
    {
        return round($this->current_accrued_value - $this->principal_amount, 2);
    }

    public function syncProjectedFigures(bool $save = true): bool
    {
        $this->loadMissing('computePlan');

        if (!$this->computePlan) {
            return false;
        }

        $principal = $this->principal_amount;
        $dailyPercent = (float) ($this->daily_profit_percent ?? $this->computePlan->daily_profit ?? 0);
        $days = max(0, ((float) $this->computePlan->duration_minutes) / 1440);

        if ($this->computePlan->compound_interest) {
            $expectedProfit = round(($principal * pow(1 + ($dailyPercent / 100), $days)) - $principal, 2);
        } else {
            $expectedProfit = round($principal * (($dailyPercent / 100) * $days), 2);
        }

        $hasChanges =
            round((float) $this->amount, 2) !== $principal ||
            round((float) $this->expected_profit, 2) !== $expectedProfit ||
            $this->investment_amount === null;

        $this->amount = $principal;
        $this->investment_amount = $principal;
        $this->expected_profit = $expectedProfit;

        if ($hasChanges && $save) {
            $this->save();
        }

        return $hasChanges;
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
