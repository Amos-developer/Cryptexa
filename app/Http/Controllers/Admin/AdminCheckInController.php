<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CheckIn;

class AdminCheckInController extends Controller
{
    public function index()
    {
        $checkIns = CheckIn::with('user')->latest()->paginate(10);
        $totalCheckIns = CheckIn::count();
        $totalRewards = CheckIn::sum('reward');
        $todayCheckIns = CheckIn::whereDate('check_in_date', today())->count();
        $avgStreak = CheckIn::avg('streak');
        
        return view('admin.checkins.index', compact('checkIns', 'totalCheckIns', 'totalRewards', 'todayCheckIns', 'avgStreak'));
    }

    public function edit($id)
    {
        $checkIn = CheckIn::with('user')->findOrFail($id);
        return view('admin.checkins.edit', compact('checkIn'));
    }

    public function update(\Illuminate\Http\Request $request, $id)
    {
        $checkIn = CheckIn::findOrFail($id);
        
        $request->validate([
            'streak' => 'required|integer|min:1',
            'reward' => 'required|numeric|min:0',
        ]);
        
        $checkIn->update($request->only(['streak', 'reward']));
        
        return redirect()->route('admin.checkins.index')->with('success', 'Check-in updated successfully');
    }

    public function destroy($id)
    {
        $checkIn = CheckIn::findOrFail($id);
        $checkIn->delete();
        
        return redirect()->route('admin.checkins.index')->with('success', 'Check-in deleted successfully');
    }
}
