<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ComputePlan;
use App\Models\ComputeOrder;
use App\Models\User;
use App\Http\Controllers\Traits\SetsLocale;


class HomeController extends Controller
{
    use SetsLocale;
    
    public function home(){
        $this->setLocale();
        
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
        $this->setLocale();
        return view('show-plan', compact('plan'));
    }
}
