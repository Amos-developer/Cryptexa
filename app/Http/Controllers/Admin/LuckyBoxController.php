<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LuckyBox;

class LuckyBoxController extends Controller
{
    public function index()
    {
        $luckyBoxes = LuckyBox::with('user')->latest()->paginate(20);
        $totalClaims = LuckyBox::count();
        $totalRewards = LuckyBox::sum('reward');
        $todayClaims = LuckyBox::whereDate('created_at', today())->count();
        $avgReward = LuckyBox::avg('reward');
        
        return view('admin.lucky-boxes.index', compact('luckyBoxes', 'totalClaims', 'totalRewards', 'todayClaims', 'avgReward'));
    }
}
