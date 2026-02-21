<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReferralController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | LEVEL 1 REFERRALS
        |--------------------------------------------------------------------------
        */
        $level1 = User::where('referred_by', $user->id)->get();

        /*
        |--------------------------------------------------------------------------
        | LEVEL 2 REFERRALS
        |--------------------------------------------------------------------------
        */
        $level2 = User::whereIn(
            'referred_by',
            $level1->pluck('id')
        )->get();

        /*
        |--------------------------------------------------------------------------
        | LEVEL 3 REFERRALS
        |--------------------------------------------------------------------------
        */
        $level3 = User::whereIn(
            'referred_by',
            $level2->pluck('id')
        )->get();

        /*
        |--------------------------------------------------------------------------
        | MEMBERS STATS
        |--------------------------------------------------------------------------
        */
        $totalMembers   = $level1->count();
        $activeMembers  = $level1->where('balance', '>', 3)->count();
        $inactiveMembers = $level1->where('balance', '<=', 3)->count();

        /*
        |--------------------------------------------------------------------------
        | REFERRAL EARNINGS
        |--------------------------------------------------------------------------
        */
        $earnings = $user->referral_earnings ?? 0;

        /*
        |--------------------------------------------------------------------------
        | CHART DATA (Last 7 Days Earnings)
        |--------------------------------------------------------------------------
        | Assumes you have a referral_transactions table
        | with columns: user_id, amount, created_at
        |--------------------------------------------------------------------------
        */

        $chartLabels = [];
        $chartData   = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);

            $chartLabels[] = $date->format('D');

            $dailyTotal = DB::table('referral_transactions')
                ->where('user_id', $user->id)
                ->whereDate('created_at', $date)
                ->sum('amount');

            $chartData[] = $dailyTotal ?? 0;
        }

        /*
        |--------------------------------------------------------------------------
        | LEADERBOARD (Top 5 Referrers)
        |--------------------------------------------------------------------------
        | Requires column: total_ref_earnings in users table
        |--------------------------------------------------------------------------
        */

        $topReferrers = User::orderByDesc('referral_earnings')
            ->take(5)
            ->get();

        return view('team', compact(
            'level1',
            'level2',
            'level3',
            'totalMembers',
            'activeMembers',
            'inactiveMembers',
            'earnings',
            'chartLabels',
            'chartData',
            'topReferrers'
        ));
    }
}
