<?php

namespace App\Http\Controllers;

use App\Models\ComputePlan;
use App\Models\ComputeOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ComputeController extends Controller
{
    /**
     * Activate a compute plan
     */
    public function unlock(int $id)
    {
        $user = auth()->user();
        $plan = ComputePlan::findOrFail($id);

        /**
         * 1️⃣ One compute per day per user
         */
        $alreadyToday = ComputeOrder::where('user_id', $user->id)
            ->whereDate('created_at', today())
            ->exists();

        if ($alreadyToday) {
            return back()->with('error', 'You can only activate one compute plan per day.');
        }

        /**
         * 2️⃣ Ensure sufficient balance
         */
        if ($user->balance < $plan->price) {
            return back()->with('error', 'Insufficient balance. Please deposit funds.');
        }

        /**
         * 3️⃣ Execute everything atomically
         */
        DB::transaction(function () use ($user, $plan) {

            // Deduct capital
            $user->decrement('balance', $plan->price);

            // Generate profit %
            $profitPercent = mt_rand(
                (int) ($plan->min_profit * 100),
                (int) ($plan->max_profit * 100)
            ) / 100;

            $expectedProfit = round(
                ($plan->price * $profitPercent) / 100,
                2
            );

            $profitAmount = round(($plan->price * $profitPercent) / 100, 2);

            // Create compute order
            ComputeOrder::create([
                'user_id'         => $user->id,
                'compute_plan_id' => $plan->id,
                'capital'         => $plan->price,
                'amount'            => $plan->price,       
                'expected_profit'   => $expectedProfit,   
                'profit'          => $profitAmount,
                'started_at'      => now(),
                'ends_at'         => now()->addMinutes($plan->duration_minutes),
                'status'          => 'running',
            ]);

            // Pay referral commissions
            $this->payReferralBonuses($user, $plan->price);
        });

        return redirect()->route('home')
            ->with('success', 'Compute plan activated successfully.');
    }

    /**
     * Referral commissions (3 levels)
     */
    protected function payReferralBonuses(User $user, float $amount): void
    {
        $levels = [
            1 => 0.04,
            2 => 0.02,
            3 => 0.01,
        ];

        $referrer = $user->referrer;

        foreach ($levels as $level => $rate) {
            if (!$referrer) {
                break;
            }

            $bonus = round($amount * $rate, 2);

            $referrer->increment('balance', $bonus);
            $referrer->increment('referral_earnings', $bonus);

            $referrer = $referrer->referrer;
        }
    }

    /**
     * Track latest compute order
     * ❌ NO balance updates here
     */
    public function track()
    {
        $order = ComputeOrder::where('user_id', auth()->id())
            ->latest()
            ->first();

        return view('track', compact('order'));
    }
}
