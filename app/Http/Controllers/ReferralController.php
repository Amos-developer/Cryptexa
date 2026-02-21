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
        | REFERRAL LEVELS (1-6)
        |--------------------------------------------------------------------------
        */

        // Level 1: Direct referrals
        $level1 = User::where('referred_by', $user->id)->get();

        // Level 2
        $level2 = User::whereIn(
            'referred_by',
            $level1->pluck('id')
        )->get();

        // Level 3
        $level3 = User::whereIn(
            'referred_by',
            $level2->pluck('id')
        )->get();

        // Level 4
        $level4 = User::whereIn(
            'referred_by',
            $level3->pluck('id')
        )->get();

        // Level 5
        $level5 = User::whereIn(
            'referred_by',
            $level4->pluck('id')
        )->get();

        // Level 6
        $level6 = User::whereIn(
            'referred_by',
            $level5->pluck('id')
        )->get();

        /*
        |--------------------------------------------------------------------------
        | ACTIVE MEMBERS STATS (balance > 0)
        |--------------------------------------------------------------------------
        */
        $level1Active = $level1->where('balance', '>', 0)->count();
        $level2Active = $level2->where('balance', '>', 0)->count();
        $level3Active = $level3->where('balance', '>', 0)->count();
        $level4Active = $level4->where('balance', '>', 0)->count();
        $level5Active = $level5->where('balance', '>', 0)->count();
        $level6Active = $level6->where('balance', '>', 0)->count();

        $totalActiveMembers = $level1Active + $level2Active + $level3Active + $level4Active + $level5Active + $level6Active;
        $totalMembers = $level1->count() + $level2->count() + $level3->count() + $level4->count() + $level5->count() + $level6->count();

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
            'level4',
            'level5',
            'level6',
            'level1Active',
            'level2Active',
            'level3Active',
            'level4Active',
            'level5Active',
            'level6Active',
            'totalMembers',
            'totalActiveMembers',
            'earnings'
        ));
    }
}
