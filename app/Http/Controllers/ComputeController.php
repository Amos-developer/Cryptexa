<?php

namespace App\Http\Controllers;

use App\Models\ComputePlan;
use App\Models\ComputeOrder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ComputeController extends Controller
{
    public function unlock(int $id)
    {
        $user = auth()->user();
        $plan = ComputePlan::findOrFail($id);

        // ✅ Allow ONLY 2 computes per day
        $todayCount = ComputeOrder::where('user_id', $user->id)
            ->whereDate('created_at', today())
            ->count();

        if ($todayCount >= 2) {
            return back()->with('error', 'You can only activate two compute plans per day.');
        }

        if ($user->balance < $plan->price) {
            return back()->with('error', 'Insufficient balance.');
        }

        DB::transaction(function () use ($user, $plan) {

            // Deduct capital
            $user->decrement('balance', $plan->price);

            // Random profit %
            $profitPercent = mt_rand(
                $plan->min_profit * 100,
                $plan->max_profit * 100
            ) / 100;

            $expectedProfit = round(($plan->price * $profitPercent) / 100, 2);

            ComputeOrder::create([
                'user_id'         => $user->id,
                'compute_plan_id' => $plan->id,
                'amount'          => $plan->price,
                'expected_profit' => $expectedProfit,
                'started_at'      => now(),
                'ends_at'         => now()->addMinutes($plan->duration_minutes),
                'status'          => 'running',
                'is_paid'         => false,
            ]);

            $this->payReferralBonuses($user, $plan->price);
        });

        return redirect()->route('home')
            ->with('success', 'Compute plan activated successfully.');
    }

    protected function payReferralBonuses(User $user, float $amount): void
    {
        $levels = [0.04, 0.02, 0.01];
        $referrer = $user->referrer;

        foreach ($levels as $rate) {
            if (!$referrer) break;

            $bonus = round($amount * $rate, 2);
            $referrer->increment('balance', $bonus);
            $referrer->increment('referral_earnings', $bonus);

            $referrer = $referrer->referrer;
        }
    }

    public function track()
    {
        $activeOrders = ComputeOrder::where('user_id', auth()->id())
            ->where('status', 'running')
            ->latest()
            ->get();

        $completedOrders = ComputeOrder::where('user_id', auth()->id())
            ->where('status', 'completed')
            ->latest()
            ->get();

        return view('track', compact('activeOrders', 'completedOrders'));
    }
}
