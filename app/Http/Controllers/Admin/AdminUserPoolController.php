<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ComputeOrder;
use Illuminate\Http\Request;

class AdminUserPoolController extends Controller
{
    public function index()
    {
        $userPools = ComputeOrder::with(['user', 'computePlan'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $totalActive = ComputeOrder::where('status', 'running')->count();
        $totalInactive = ComputeOrder::where('status', 'completed')->count();
        $totalRevenue = ComputeOrder::where('status', 'completed')->sum('expected_profit');

        return view('admin.user-pools.index', compact('userPools', 'totalActive', 'totalInactive', 'totalRevenue'));
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
        $userPool = ComputeOrder::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:running,completed',
            'expected_profit' => 'nullable|numeric|min:0',
        ]);

        // If status is being changed to completed, credit user
        if ($request->status == 'completed' && $userPool->status == 'running') {
            $totalReturn = $userPool->amount + $userPool->expected_profit;
            $userPool->user->increment('balance', $totalReturn);
            $userPool->update([
                'status' => 'completed',
                'is_paid' => true,
                'expected_profit' => $request->expected_profit ?? $userPool->expected_profit,
            ]);
        } else {
            $userPool->update($request->only(['status', 'expected_profit']));
        }

        return redirect()->route('admin.user-pools.index')->with('success', 'User pool updated successfully');
    }
}
