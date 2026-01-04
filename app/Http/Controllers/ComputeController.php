<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ComputePlan;
use App\Models\ComputeOrder;
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

        return redirect()->route('home')
            ->with('success', 'Compute plan activated successfully!');
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
}
