<?php

namespace App\Http\Controllers;

use App\Models\ComputePlan;      // Keep model for now
use App\Models\ComputeOrder;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

class ComputeController extends Controller
{
    public function activatePool(int $id)
    {
        $user = auth()->user();
        $plan = ComputePlan::findOrFail($id);

        // Check if user has any running orders
        $hasRunningOrder = ComputeOrder::where('user_id', $user->id)
            ->where('status', 'running')
            ->exists();

        if ($hasRunningOrder) {
            return back()->with('error', 'You already have an active pool. Please wait until it completes before activating another.');
        }

        if ($user->balance < $plan->price) {
            return back()->with('error', 'Insufficient balance.');
        }

        DB::transaction(function () use ($user, $plan) {

            $user->decrement('balance', $plan->price);

            // Random daily percentage within range (as percentage, not decimal)
            $dailyPercent = mt_rand(
                $plan->min_profit * 10,
                $plan->max_profit * 10
            ) / 10;

            $principal = $plan->price;
            $days = $plan->duration_minutes / 1440;

            // Calculate expected profit with compound interest (convert percentage to decimal)
            $finalAmount = $principal * pow((1 + ($dailyPercent / 100)), $days);
            $expectedProfit = round($finalAmount - $principal, 2);

            $order = ComputeOrder::create([
                'user_id'         => $user->id,
                'compute_plan_id' => $plan->id,
                'amount'          => $principal,
                'investment_amount' => $principal,
                'expected_profit' => $expectedProfit,
                'daily_profit_percent' => $dailyPercent,
                'started_at'      => now(),
                'ends_at'         => now()->addDays($days),
                'last_compound_at' => now(),
                'status'          => 'running',
                'is_paid'         => false,
            ]);

            // Create notification for pool activation
            Notification::create([
                'user_id'   => $user->id,
                'type'      => 'plan_activated',
                'title'     => 'Liquidity Pool Activated',
                'message'   => "Your {$plan->name} pool has been activated with ${$principal}. Expected profit: ${$expectedProfit}",
                'icon_type' => 'success',
                'is_read'   => false,
                'data'      => [
                    'order_id' => $order->id,
                    'plan_id'  => $plan->id,
                    'amount'   => $principal,
                ],
            ]);
        });

        return redirect()->route('home')
            ->with('success', 'Liquidity pool activated successfully.');
    }

    public function track()
    {
        $completingOrders = ComputeOrder::where('user_id', auth()->id())
            ->where('status', 'running')
            ->where('ends_at', '<=', now())
            ->get();

        foreach ($completingOrders as $order) {
            DB::transaction(function () use ($order) {

                $totalReturn = $order->amount + $order->expected_profit;

                $order->user->increment('balance', $totalReturn);

                $order->update([
                    'status' => 'completed',
                    'is_paid' => true,
                ]);
            });
        }

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
