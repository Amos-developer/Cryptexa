<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\RankBonusService;

class RankBonusController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')
            ->where(function($q) {
                $q->where('junior_leader_bonus_paid', true)
                  ->orWhere('elite_leader_bonus_paid', true)
                  ->orWhere('legendary_leader_bonus_paid', true)
                  ->orWhere('grand_leader_bonus_paid', true);
            })
            ->withCount('referrals')
            ->latest()
            ->paginate(10);
        
        $totalJunior = User::where('junior_leader_bonus_paid', true)->count();
        $totalElite = User::where('elite_leader_bonus_paid', true)->count();
        $totalLegendary = User::where('legendary_leader_bonus_paid', true)->count();
        $totalGrand = User::where('grand_leader_bonus_paid', true)->count();
        
        $totalPaid = ($totalJunior * 5) + ($totalElite * 20) + ($totalLegendary * 50) + ($totalGrand * 150);
        
        return view('admin.rank-bonuses.index', compact('users', 'totalJunior', 'totalElite', 'totalLegendary', 'totalGrand', 'totalPaid'));
    }

    public function edit($id)
    {
        $user = User::withCount('referrals')->findOrFail($id);
        return view('admin.rank-bonuses.edit', compact('user'));
    }

    public function update(\Illuminate\Http\Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $user->update([
            'junior_leader_bonus_paid' => $request->has('junior_leader_bonus_paid'),
            'elite_leader_bonus_paid' => $request->has('elite_leader_bonus_paid'),
            'legendary_leader_bonus_paid' => $request->has('legendary_leader_bonus_paid'),
            'grand_leader_bonus_paid' => $request->has('grand_leader_bonus_paid'),
        ]);
        
        return redirect()->route('admin.rank-bonuses.index')->with('success', 'Rank bonuses updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        $user->update([
            'junior_leader_bonus_paid' => false,
            'elite_leader_bonus_paid' => false,
            'legendary_leader_bonus_paid' => false,
            'grand_leader_bonus_paid' => false,
        ]);
        
        return redirect()->route('admin.rank-bonuses.index')->with('success', 'All rank bonuses reset for user');
    }
}
