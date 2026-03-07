<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReferralEarning;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function index(Request $request)
    {
        $query = ReferralEarning::with(['user', 'fromUser']);
        
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }
        
        $commissions = $query->latest()->paginate(20);
        $totalCommissions = ReferralEarning::sum('amount');
        $level1Total = ReferralEarning::where('level', 1)->sum('amount');
        $level2Total = ReferralEarning::where('level', 2)->sum('amount');
        $level3Total = ReferralEarning::where('level', 3)->sum('amount');
        
        return view('admin.commissions.index', compact('commissions', 'totalCommissions', 'level1Total', 'level2Total', 'level3Total'));
    }

    public function show($id)
    {
        $commission = ReferralEarning::with(['user', 'fromUser'])->findOrFail($id);
        return view('admin.commissions.show', compact('commission'));
    }

    public function edit($id)
    {
        $commission = ReferralEarning::with(['user', 'fromUser'])->findOrFail($id);
        return view('admin.commissions.edit', compact('commission'));
    }

    public function update(Request $request, $id)
    {
        $commission = ReferralEarning::findOrFail($id);
        
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'level' => 'required|integer|min:1|max:3',
        ]);
        
        $commission->update($request->only(['amount', 'level']));
        
        return redirect()->route('admin.commissions.index')->with('success', 'Commission updated successfully');
    }

    public function destroy($id)
    {
        $commission = ReferralEarning::findOrFail($id);
        $commission->delete();
        
        return redirect()->route('admin.commissions.index')->with('success', 'Commission deleted successfully');
    }
}
