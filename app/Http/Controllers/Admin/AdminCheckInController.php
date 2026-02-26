<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CheckIn;

class AdminCheckInController extends Controller
{
    public function index()
    {
        $checkIns = CheckIn::with('user')->latest()->paginate(20);
        $totalCheckIns = CheckIn::count();
        $totalRewards = CheckIn::sum('reward');
        $todayCheckIns = CheckIn::whereDate('check_in_date', today())->count();
        $avgStreak = CheckIn::avg('streak');
        
        return view('admin.checkins.index', compact('checkIns', 'totalCheckIns', 'totalRewards', 'todayCheckIns', 'avgStreak'));
    }
}
