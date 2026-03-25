<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ComputeOrder;
use App\Models\Notification;
use Illuminate\Http\Request;

class AdminUserPoolController extends Controller
{
    public function index()
    {
        $userPools = ComputeOrder::with(['user', 'computePlan'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $totalRunning = ComputeOrder::where('status', 'running')->count();
        $totalCompleted = ComputeOrder::where('status', 'completed')->count();
        $totalRevenue = ComputeOrder::where('status', 'completed')->sum('expected_profit');
        $totalInvested = (float) ComputeOrder::query()
            ->selectRaw('COALESCE(SUM(COALESCE(investment_amount, amount)), 0) as total')
            ->value('total');

        return view('admin.user-pools.index', compact('userPools', 'totalRunning', 'totalCompleted', 'totalRevenue', 'totalInvested'));
    }

    public function show($id)
    {
        $userPool = ComputeOrder::with(['user', 'computePlan'])->findOrFail($id);
        return view('admin.user-pools.show', compact('userPool'));
    }

    public function edit($id)
    {
        $userPool = ComputeOrder::with(['user', 'computePlan'])->findOrFail($id);
        return view('admin.user-pools.edit', compact('userPool'));
    }

    public function update(Request $request, $id)
    {
        $userPool = ComputeOrder::with('computePlan')->findOrFail($id);
        $plan = $userPool->computePlan;
        
        // Strong validation for amount if being updated
        $rules = [
            'status' => 'required|in:running,completed',
            'expected_profit' => 'nullable|numeric|min:0',
        ];
        
        if ($request->has('amount')) {
            $rules['amount'] = 'required|numeric|min:' . $plan->price;
            if ($plan->max_investment) {
                $rules['amount'] .= '|max:' . $plan->max_investment;
            }
        }
        
        $request->validate($rules);
        
        // Server-side double check for amount
        if ($request->has('amount')) {
            $amount = $request->input('amount');
            if ($amount < $plan->price) {
                return back()->with('error', 'Investment amount must be at least $' . number_format($plan->price, 2));
            }
            if ($plan->max_investment && $amount > $plan->max_investment) {
                return back()->with('error', 'Investment amount cannot exceed $' . number_format($plan->max_investment, 2));
            }
        }

        // If status is being changed to completed, credit user
        if ($request->status == 'completed' && $userPool->status == 'running') {
            $principal = (float) ($request->amount ?? $userPool->principal_amount);
            $profit = (float) ($request->expected_profit ?? $userPool->expected_profit);
            $totalReturn = $principal + $profit;
            $userPool->user->increment('balance', $totalReturn);
            $userPool->user->refresh();
            $balanceAfter = $userPool->user->balance;
            
            $userPool->update([
                'amount' => $principal,
                'investment_amount' => $principal,
                'status' => 'completed',
                'is_paid' => true,
                'expected_profit' => $profit,
                'balance_after' => $balanceAfter,
            ]);
            
            Notification::create([
                'user_id' => $userPool->user_id,
                'type' => 'pool_completed',
                'title' => 'Pool Completed',
                'message' => "Your {$userPool->computePlan->name} pool has completed! Total return: $" . number_format($totalReturn, 2),
                'icon_type' => 'success',
                'is_read' => false,
            ]);
        } else {
            $updateData = $request->only(['status', 'expected_profit']);

            if ($request->has('amount')) {
                $updateData['amount'] = $request->amount;
                $updateData['investment_amount'] = $request->amount;
            }

            $userPool->update($updateData);
        }

        return redirect()->route('admin.user-pools.index')->with('success', 'User pool updated successfully');
    }
}
