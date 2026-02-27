<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ComputePlan;
use App\Models\ComputeOrder;
use App\Models\User;


class HomeController extends Controller
{
    public function home(){
        if (auth()->check() && auth()->user()->language) {
            app()->setLocale(auth()->user()->language);
        }
        
        $plans = ComputePlan::all();
        $orders = ComputeOrder::with('computePlan')
            ->where('user_id', auth()->id())
            ->latest()
            ->take(10)
            ->get();

        return view('home', compact('plans', 'orders'));
    }

    public function showComputePlan(ComputePlan $plan)
    {

        return view('show-plan', compact('plan'));
    }
}
