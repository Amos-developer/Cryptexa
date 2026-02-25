<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Services\RankBonusService;

class ReferralController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Check and pay rank bonuses
        $rankBonusService = new RankBonusService();
        $bonusesPaid = $rankBonusService->checkAndPayRankBonuses($user);

        /*
        |--------------------------------------------------------------------------
        | REFERRAL LEVELS (1-3)
        |--------------------------------------------------------------------------
        */

        // Level 1: Direct referrals
        $level1 = User::where('referred_by', $user->id)->where('role', '!=', 'admin')->get();

        // Level 2
        $level2 = User::whereIn(
            'referred_by',
            $level1->pluck('id')
        )->where('role', '!=', 'admin')->get();

        // Level 3
        $level3 = User::whereIn(
            'referred_by',
            $level2->pluck('id')
        )->where('role', '!=', 'admin')->get();

        /*
        |--------------------------------------------------------------------------
        | ACTIVE MEMBERS STATS (users with completed deposits)
        |--------------------------------------------------------------------------
        */
        $level1Active = $level1->filter(
            fn($user) =>
            DB::table('deposits')->where('user_id', $user->id)->where('status', 'completed')->exists()
        )->count();

        $level2Active = $level2->filter(
            fn($user) =>
            DB::table('deposits')->where('user_id', $user->id)->where('status', 'completed')->exists()
        )->count();

        $level3Active = $level3->filter(
            fn($user) =>
            DB::table('deposits')->where('user_id', $user->id)->where('status', 'completed')->exists()
        )->count();

        $totalActiveMembers = $level1Active + $level2Active + $level3Active;
        $totalMembers = $level1->count() + $level2->count() + $level3->count();

        /*
        |--------------------------------------------------------------------------
        | REFERRAL EARNINGS
        |--------------------------------------------------------------------------
        */
        $earnings = $user->referral_earnings ?? 0;

        return view('team', compact(
            'level1',
            'level2',
            'level3',
            'level1Active',
            'level2Active',
            'level3Active',
            'totalMembers',
            'totalActiveMembers',
            'earnings'
        ));
    }

    public function weeklySalary()
    {
        $user = auth()->user();
        $rankBonusService = new RankBonusService();
        
        // Check and pay rank bonuses
        $rankBonusService->checkAndPayRankBonuses($user);
        
        // Get rank info
        $rankInfo = $rankBonusService->getRankInfo($user);
        
        $totalReferrals = User::where('referred_by', $user->id)->where('role', '!=', 'admin')->count();
        $activeReferrals = User::where('referred_by', $user->id)
            ->where('role', '!=', 'admin')
            ->whereHas('deposits', fn($q) => $q->where('status', 'completed'))
            ->count();
        
        $rankName = $rankInfo['name'];
        $weeklySalary = $rankInfo['weekly_salary'];
        $activeMembers = $rankInfo['active_members'];
        
        $nextPaymentDate = now()->next('Monday');
        
        // Get rank bonus status
        $rankBonuses = [
            'junior_leader' => ['amount' => 5, 'required' => 3, 'paid' => $user->junior_leader_bonus_paid],
            'elite_leader' => ['amount' => 20, 'required' => 10, 'paid' => $user->elite_leader_bonus_paid],
            'legendary_leader' => ['amount' => 50, 'required' => 30, 'paid' => $user->legendary_leader_bonus_paid],
            'grand_leader' => ['amount' => 150, 'required' => 100, 'paid' => $user->grand_leader_bonus_paid],
        ];

        return view('referral.weekly-salary', compact('totalReferrals', 'activeReferrals', 'weeklySalary', 'nextPaymentDate', 'rankName', 'activeMembers', 'rankBonuses'));
    }

    public function leaderboard()
    {
        $user = auth()->user();
        $rankBonusService = new RankBonusService();
        
        // Check and pay rank bonuses
        $rankBonusService->checkAndPayRankBonuses($user);
        
        // Get rank info
        $rankInfo = $rankBonusService->getRankInfo($user);
        
        $leaderboard = User::where('role', '!=', 'admin')
            ->withCount(['deposits' => fn($q) => $q->where('status', 'completed')])
            ->orderByDesc('referral_earnings')
            ->take(5)
            ->get();
        
        $userRank = User::where('role', '!=', 'admin')
            ->where('referral_earnings', '>', $user->referral_earnings ?? 0)
            ->count() + 1;
        
        // Get rank bonus status
        $rankBonuses = [
            'junior_leader' => ['amount' => 5, 'required' => 3, 'paid' => $user->junior_leader_bonus_paid],
            'elite_leader' => ['amount' => 20, 'required' => 10, 'paid' => $user->elite_leader_bonus_paid],
            'legendary_leader' => ['amount' => 50, 'required' => 30, 'paid' => $user->legendary_leader_bonus_paid],
            'grand_leader' => ['amount' => 150, 'required' => 100, 'paid' => $user->grand_leader_bonus_paid],
        ];
        
        $activeMembers = $rankInfo['active_members'];

        return view('referral.leaderboard', compact('leaderboard', 'userRank', 'rankBonuses', 'activeMembers'));
    }
}
