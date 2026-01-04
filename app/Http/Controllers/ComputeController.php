<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ComputePlan;
use App\Models\ComputeOrder;
use App\Services\ReferralService;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;

class ComputeController extends Controller
{
    public function unlock($id)
    {
        $user = auth()->user();
        $plan = ComputePlan::findOrFail($id);

        // 1️⃣ CHECK: ONE ORDER PER DAY
        $todayOrder = ComputeOrder::where('user_id', $user->id)
            ->whereDate('created_at', Carbon::today())
            ->first();

        if ($todayOrder) {
            return redirect()->back()->with('error', 'You can only activate one compute plan per day.');
        }

        // ❌ Insufficient balance
        if ($user->balance < $plan->price) {
            return redirect()->back()
                ->with('error', 'Insufficient balance. Please deposit funds.');
        }

        // ✅ Deduct balance
        $user->decrement('balance', $plan->price);

        // ✅ Generate profit (random within range)
        $profitPercent = rand(
            $plan->min_profit * 100,
            $plan->max_profit * 100
        ) / 100;

        $profitAmount = ($plan->price * $profitPercent) / 100;

        // ✅ Create compute order
        ComputeOrder::create([
            'user_id'           => $user->id,
            'compute_plan_id'   => $plan->id,
            'amount'            => $plan->price,
            'expected_profit'   => $profitAmount,
            'started_at'        => now(),
            'ends_at'           => now()->addMinutes($plan->duration_minutes),
            'status'            => 'running', // recommended
        ]);

        // 🚀 REFERRAL BONUSES
        $this->creditReferralBonuses($user, $plan->price);


        return redirect()->route('home')
            ->with('success', 'Compute plan activated successfully!');
    }

    // Add refferral bonuses
    protected function creditReferralBonuses(User $user, float $amount)
    {
        // LEVEL 1 – 4%
        if ($user->referrer) {
            $bonus1 = round($amount * 0.04, 2);

            $user->referrer->increment('balance', $bonus1);
            $user->referrer->increment('referral_earnings', $bonus1);

            // LEVEL 2 – 2%
            if ($user->referrer->referrer) {
                $bonus2 = round($amount * 0.02, 2);

                $user->referrer->referrer->increment('balance', $bonus2);
                $user->referrer->referrer->increment('referral_earnings', $bonus2);

                // LEVEL 3 – 1%
                if ($user->referrer->referrer->referrer) {
                    $bonus3 = round($amount * 0.01, 2);

                    $user->referrer->referrer->referrer->increment('balance', $bonus3);
                    $user->referrer->referrer->referrer->increment('referral_earnings', $bonus3);
                }
            }
        }
    }



    // TRACK ORDER
    public function track()
    {
        $order = ComputeOrder::where('user_id', auth()->id())
            ->latest()
            ->first();

        if (!$order) {
            return view('track')->with('order', null);
        }

        // Auto-complete order
        if ($order->status === 'running' && $order->isCompleted()) {
            $order->update(['status' => 'completed']);

            // credit profit once
            auth()->user()->increment('balance', $order->expected_profit);
        }

        return view('track', compact('order'));
    }

    public function purchase($planId, ReferralService $referralService)
    {
        $user = auth()->user();
        $plan = ComputePlan::findOrFail($planId);

        if ($user->balance < $plan->price) {
            return back()->with('error', 'Insufficient balance');
        }

        DB::transaction(function () use ($user, $plan, $referralService) {

            // 1️⃣ Deduct user balance
            $user->decrement('balance', $plan->price);

            // 2️⃣ Create compute order
            ComputeOrder::create([
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'amount' => $plan->price,
                'status' => 'running',
            ]);

            // 3️⃣ Pay referral commissions 🔥
            $referralService->handleComputeCommission(
                $user,
                $plan->price
            );
        });

        return back()->with('success', 'Compute plan started');
    }
}
