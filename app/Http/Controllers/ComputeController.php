<?php

namespace App\Http\Controllers;

use App\Models\ComputePlan;      // Keep model for now
use App\Models\ComputeOrder;
use App\Models\User;
use App\Models\Notification;
use App\Models\ReferralEarning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Traits\SetsLocale;

class ComputeController extends Controller
{
    use SetsLocale;
    
    public function activatePool(Request $request, int $id)
    {
        $this->setLocale();
        $user = auth()->user();
        $plan = ComputePlan::findOrFail($id);

        $amount = $request->input('amount');

        // Strong validation
        $rules = [
            'amount' => 'required|numeric|min:' . $plan->price,
        ];
        
        if ($plan->max_investment) {
            $rules['amount'] .= '|max:' . $plan->max_investment;
        }
        
        $request->validate($rules);

        // Server-side double check to prevent bypass
        if ($amount < $plan->price) {
            return back()->with('error', 'Investment amount must be at least $' . number_format($plan->price, 2));
        }
        
        if ($plan->max_investment && $amount > $plan->max_investment) {
            return back()->with('error', 'Investment amount cannot exceed $' . number_format($plan->max_investment, 2));
        }

        // Check if user has any running orders
        $hasRunningOrder = ComputeOrder::where('user_id', $user->id)
            ->where('status', 'running')
            ->exists();

        if ($hasRunningOrder) {
            return back()->with('error', 'You already have an active pool. Please wait until it completes before activating another.');
        }

        if ($user->balance < $amount) {
            return back()->with('error', 'Insufficient balance.');
        }

        DB::transaction(function () use ($user, $plan, $amount) {
            $balanceBefore = $user->balance;

            $user->decrement('balance', $amount);

            // Use fixed daily percentage
            $dailyPercent = $plan->daily_profit;

            $principal = $amount;
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
                'balance_before'  => $balanceBefore,
            ]);

            // Create notification for pool activation
            $principalFormatted = number_format($principal, 2);
            $expectedProfitFormatted = number_format($expectedProfit, 2);
            
            Notification::create([
                'user_id'   => $user->id,
                'type'      => 'plan_activated',
                'title'     => 'Liquidity Pool Activated',
                'message'   => "Your {$plan->name} pool has been activated with \${$principalFormatted}. Expected profit: \${$expectedProfitFormatted}",
                'icon_type' => 'success',
                'is_read'   => false,
                'data'      => [
                    'order_id' => $order->id,
                    'plan_id'  => $plan->id,
                    'amount'   => $principal,
                ],
            ]);
        });

        return redirect()->route('compute.track')
            ->with('success', 'Liquidity pool activated successfully.');
    }

    public function track()
    {
        $this->setLocale();
        // Process any completed orders for this user
        $completingOrders = ComputeOrder::where('user_id', auth()->id())
            ->where('status', 'running')
            ->where('ends_at', '<=', now())
            ->where('is_paid', false)
            ->get();

        foreach ($completingOrders as $order) {
            DB::transaction(function () use ($order) {
                $totalReturn = $order->amount + $order->expected_profit;
                $order->user->increment('balance', $totalReturn);
                $order->user->refresh();
                $balanceAfter = $order->user->balance;
                
                $order->update([
                    'status' => 'completed',
                    'is_paid' => true,
                    'balance_after' => $balanceAfter,
                ]);
                
                Notification::create([
                    'user_id' => $order->user_id,
                    'type' => 'pool_completed',
                    'title' => 'Pool Completed',
                    'message' => "Your pool has completed! Total return: $" . number_format($totalReturn, 2),
                    'icon_type' => 'success',
                    'is_read' => false,
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
