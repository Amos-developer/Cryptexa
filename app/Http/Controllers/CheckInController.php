<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckInController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $today = Carbon::now()->startOfDay();
        
        $lastCheckIn = CheckIn::where('user_id', $user->id)
            ->orderBy('check_in_date', 'desc')
            ->first();
        
        $canCheckIn = !$lastCheckIn || $lastCheckIn->check_in_date->startOfDay()->lt($today);
        $currentStreak = $lastCheckIn ? $lastCheckIn->streak : 0;
        
        // Calculate next reward based on what the NEW streak will be
        $nextStreak = 1;
        if ($lastCheckIn && $lastCheckIn->check_in_date->startOfDay()->eq($today->copy()->subDay())) {
            $nextStreak = $lastCheckIn->streak + 1;
        }
        $nextReward = 0.10 + ($nextStreak * 0.01);
        
        $checkIns = CheckIn::where('user_id', $user->id)
            ->where('check_in_date', '>=', $today->copy()->subDays(6))
            ->orderBy('check_in_date', 'desc')
            ->get();
        
        return view('checkin', compact('canCheckIn', 'currentStreak', 'nextReward', 'checkIns', 'lastCheckIn'));
    }
    
    public function store(Request $request)
    {
        $user = auth()->user();
        $today = Carbon::now()->startOfDay();
        
        $lastCheckIn = CheckIn::where('user_id', $user->id)
            ->orderBy('check_in_date', 'desc')
            ->first();
        
        if ($lastCheckIn && $lastCheckIn->check_in_date->startOfDay()->eq($today)) {
            return back()->with('error', 'You have already checked in today!');
        }
        
        $streak = 1;
        if ($lastCheckIn && $lastCheckIn->check_in_date->startOfDay()->eq($today->copy()->subDay())) {
            $streak = $lastCheckIn->streak + 1;
        }
        
        $reward = 0.10 + ($streak * 0.01);
        
        CheckIn::create([
            'user_id' => $user->id,
            'streak' => $streak,
            'reward' => $reward,
            'check_in_date' => $today,
        ]);
        
        $user->increment('balance', $reward);
        
        return redirect()->route('checkin')->with('success', "Check-in successful! You earned $" . number_format($reward, 2));
    }
}
