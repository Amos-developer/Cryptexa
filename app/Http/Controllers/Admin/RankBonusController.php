<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\RankBonus;
use App\Services\RankBonusService;
use Illuminate\Http\Request;

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
        $bonus = RankBonus::with('user')->findOrFail($id);
        return view('admin.rank-bonuses.edit', compact('bonus'));
    }

    public function update(Request $request, $id)
    {
        $bonus = RankBonus::with('user')->findOrFail($id);
        
        $request->validate([
            'rank' => 'required|string',
            'bonus_amount' => 'required|numeric|min:0',
            'balance_before' => 'required|numeric|min:0',
            'balance_after' => 'required|numeric|min:0',
        ]);
        
        // Calculate the difference in bonus amount
        $oldBonus = $bonus->bonus_amount;
        $newBonus = $request->bonus_amount;
        $difference = $newBonus - $oldBonus;
        
        // Update user balance if bonus amount changed
        if ($difference != 0) {
            $bonus->user->increment('balance', $difference);
        }
        
        $bonus->update($request->only(['rank', 'bonus_amount', 'balance_before', 'balance_after']));
        
        return redirect()->route('admin.rewards.index', ['rankbonuses_page' => request('page', 1)])->with('success', 'Rank bonus updated successfully');
    }

    public function destroy($id)
    {
        $bonus = RankBonus::findOrFail($id);
        $bonus->delete();
        
        return redirect()->route('admin.rewards.index', ['rankbonuses_page' => request('page', 1)])->with('success', 'Rank bonus deleted successfully');
    }
}
