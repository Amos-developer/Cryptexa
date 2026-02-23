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
        | REFERRAL LEVELS (1-3)
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

        /*
        |--------------------------------------------------------------------------
        | ACTIVE MEMBERS STATS (users with actual deposits)
        |--------------------------------------------------------------------------
        */
        $level1Active = $level1->filter(
            fn($user) =>
            DB::table('deposits')->where('user_id', $user->id)->where('status', 'paid')->exists()
        )->count();

        $level2Active = $level2->filter(
            fn($user) =>
            DB::table('deposits')->where('user_id', $user->id)->where('status', 'paid')->exists()
        )->count();

        $level3Active = $level3->filter(
            fn($user) =>
            DB::table('deposits')->where('user_id', $user->id)->where('status', 'paid')->exists()
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
}
