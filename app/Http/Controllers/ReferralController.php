<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        | MEMBERS STATS (LEVEL 1)
        |--------------------------------------------------------------------------
        */
        $totalMembers = $level1->count();

        $activeMembers = $level1
            ->where('balance', '>', 3)
            ->count();

        $inactiveMembers = $level1
            ->where('balance', '<=', 3)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | REFERRAL EARNINGS (REAL DATA)
        |--------------------------------------------------------------------------
        */
        $earnings = $user->referral_earnings;

        return view('team', compact(
            'level1',
            'level2',
            'level3',
            'totalMembers',
            'activeMembers',
            'inactiveMembers',
            'earnings'
        ));
    }
}
