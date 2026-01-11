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
     * 🔓 Unlock a compute plan
     */
    public function unlock($id)
    {
        $user = auth()->user();
        $plan = ComputePlan::findOrFail($id);

        // 1️⃣ One order per day per user
        $alreadyToday = ComputeOrder::where('user_id', $user->id)
            ->whereDate('created_at', Carbon::today())
            ->exists();

        if ($alreadyToday) {
            return back()->with('error', 'You can only activate one compute plan per day.');
        }

        // 2️⃣ Check balance
        if ($user->balance < $plan->price) {
            return back()->with('error', 'Insufficient balance. Please deposit funds.');
        }

        // 3️⃣ Generate profit %
        $profitPercent = random_int(
            $plan->min_profit * 100,
            $plan->max_profit * 100
        ) / 100;

        $profitAmount = round(($plan->price * $profitPercent) / 100, 2);

        DB::transaction(function () use ($user, $plan, $profitAmount, $profitPercent) {

            // 🔒 Lock user row
            $user = User::where('id', $user->id)->lockForUpdate()->first();

            if ($user->balance < $plan->price) {
                throw new \Exception('Balance changed. Try again.');
            }

            // 4️⃣ Deduct capital (lock funds)
            $user->decrement('balance', $plan->price);

            // 5️⃣ Create compute order
            ComputeOrder::create([
                'user_id'           => $user->id,
                'compute_plan_id'   => $plan->id,
                'amount'            => $plan->price,
                'profit_percent'    => $profitPercent,
                'expected_profit'   => $profitAmount,
                'started_at'        => now(),
                'ends_at'           => now()->addMinutes($plan->duration_minutes),
                'status'            => 'running',
            ]);

            // 6️⃣ Referral bonuses (optional & safe)
            $this->creditReferralBonuses($user, $plan->price);
        });

        return redirect()->route('home')
            ->with('success', 'Compute plan activated successfully.');
    }

    /**
     * ⏱ Track latest order (SAFE AUTO-COMPLETION)
     */
    public function track()
    {
        $order = ComputeOrder::where('user_id', auth()->id())
            ->latest()
            ->first();

        if (!$order) {
            return view('track')->with('order', null);
        }

        DB::transaction(function () use ($order) {

            // 🔒 Lock order row
            $order = ComputeOrder::where('id', $order->id)
                ->lockForUpdate()
                ->first();

            if (
                $order->status === 'running' &&
                now()->gte($order->ends_at)
            ) {
                $totalReturn = $order->amount + $order->expected_profit;

                // Credit capital + profit
                $order->user->increment('balance', $totalReturn);

                $order->update([
                    'status'       => 'completed',
                    'completed_at' => now(),
                ]);
            }
        });

        return view('track', compact('order'));
    }

    /**
     * 🤝 Referral bonuses (SAFE)
     */
    protected function creditReferralBonuses(User $user, float $amount): void
    {
        // Prevent self-referral
        if (!$user->referrer || $user->referrer_id === $user->id) {
            return;
        }

        // LEVEL 1 – 4%
        $bonus1 = round($amount * 0.04, 2);
        $user->referrer->increment('balance', $bonus1);
        $user->referrer->increment('referral_earnings', $bonus1);

        // LEVEL 2 – 2%
        if ($user->referrer->referrer) {
            $bonus2 = round($amount * 0.02, 2);
            $user->referrer->referrer->increment('balance', $bonus2);
            $user->referrer->referrer->increment('referral_earnings', $bonus2);
        }

        // LEVEL 3 – 1%
        if ($user->referrer->referrer && $user->referrer->referrer->referrer) {
            $bonus3 = round($amount * 0.01, 2);
            $user->referrer->referrer->referrer->increment('balance', $bonus3);
            $user->referrer->referrer->referrer->increment('referral_earnings', $bonus3);
        }
    }
}
