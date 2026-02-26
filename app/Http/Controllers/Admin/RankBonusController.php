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
            ->paginate(20);
        
        $totalJunior = User::where('junior_leader_bonus_paid', true)->count();
        $totalElite = User::where('elite_leader_bonus_paid', true)->count();
        $totalLegendary = User::where('legendary_leader_bonus_paid', true)->count();
        $totalGrand = User::where('grand_leader_bonus_paid', true)->count();
        
        $totalPaid = ($totalJunior * 5) + ($totalElite * 20) + ($totalLegendary * 50) + ($totalGrand * 150);
        
        return view('admin.rank-bonuses.index', compact('users', 'totalJunior', 'totalElite', 'totalLegendary', 'totalGrand', 'totalPaid'));
    }
}
