<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LuckyBoxController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $today = Carbon::today();
        
        $canOpen = !DB::table('lucky_box_opens')
            ->where('user_id', $user->id)
            ->whereDate('open_date', $today)
            ->exists();
        
        return view('luckybox', compact('user', 'canOpen'));
    }
    
    public function open(Request $request)
    {
        $user = auth()->user();
        $today = Carbon::today();
        
        // Check if already opened today
        $alreadyOpened = DB::table('lucky_box_opens')
            ->where('user_id', $user->id)
            ->whereDate('open_date', $today)
            ->exists();
        
        if ($alreadyOpened) {
            return response()->json([
                'success' => false,
                'message' => 'You have already opened the lucky box today!'
            ], 400);
        }
        
        // 99% chance for 0.10-0.40, 1% chance for 0.50-1.50
        $random = rand(1, 100);
        
        if ($random <= 99) {
            // 99% - Low reward (0.10 to 0.40)
            $reward = round(rand(10, 40) / 100, 2);
        } else {
            // 1% - High reward (0.50 to 1.50)
            $reward = round(rand(50, 150) / 100, 2);
        }
        
        // Save the open record
        DB::table('lucky_box_opens')->insert([
            'user_id' => $user->id,
            'reward' => $reward,
            'open_date' => $today,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        $user->increment('balance', $reward);
        
        return response()->json([
            'success' => true,
            'reward' => $reward,
            'balance' => $user->balance
        ]);
    }
}
