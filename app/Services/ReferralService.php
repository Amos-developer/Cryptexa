<?php

namespace App\Services;

use App\Models\ReferralEarning;

class ReferralService
{
    public function handleDepositBonus($user, $amount)
    {
        $this->payUpline($user, $amount, [
            1 => 0.04,
            2 => 0.02,
            3 => 0.01,
        ], 'deposit');
    }

    public function handleComputeCommission($user, $amount)
    {
        $this->payUpline($user, $amount, [
            1 => 0.10,
            2 => 0.05,
            3 => 0.01,
        ], 'compute');
    }

    protected function payUpline($user, $amount, $rates, $type)
    {
        $current = $user->referrer;

        foreach ($rates as $level => $rate) {
            if (!$current) break;

            $bonus = round($amount * $rate, 2);

            $current->increment('balance', $bonus);

            ReferralEarning::create([
                'user_id' => $current->id,
                'from_user_id' => $user->id,
                'amount' => $bonus,
                'level' => $level,
                'type' => $type,
            ]);

            $current = $current->referrer;
        }
    }
}
