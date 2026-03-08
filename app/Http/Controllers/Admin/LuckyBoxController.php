<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LuckyBox;

class LuckyBoxController extends Controller
{
    public function index()
    {
        $luckyBoxes = LuckyBox::with('user')->latest()->paginate(10);
        $totalClaims = LuckyBox::count();
        $totalRewards = LuckyBox::sum('reward');
        $todayClaims = LuckyBox::whereDate('created_at', today())->count();
        $avgReward = LuckyBox::avg('reward');
        
        return view('admin.lucky-boxes.index', compact('luckyBoxes', 'totalClaims', 'totalRewards', 'todayClaims', 'avgReward'));
    }

    public function edit($id)
    {
        $luckyBox = LuckyBox::with('user')->findOrFail($id);
        return view('admin.lucky-boxes.edit', compact('luckyBox'));
    }

    public function update(\Illuminate\Http\Request $request, $id)
    {
        $luckyBox = LuckyBox::findOrFail($id);
        
        $request->validate([
            'reward' => 'required|numeric|min:0',
        ]);
        
        $luckyBox->update($request->only(['reward']));
        
        return redirect()->route('admin.lucky-boxes.index')->with('success', 'Lucky box updated successfully');
    }

    public function destroy($id)
    {
        $luckyBox = LuckyBox::findOrFail($id);
        $luckyBox->delete();
        
        return redirect()->route('admin.lucky-boxes.index')->with('success', 'Lucky box deleted successfully');
    }
}
