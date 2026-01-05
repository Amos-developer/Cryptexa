<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Deposit;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard',[
            'totalUsers' => User::count(),
            'totalDeposits' => Deposit::where('status', 'completed')->sum('amount'),
            'pendingDeposits' => Deposit::where('status', 'pending')->count(),
            'recentDeposits' => Deposit::latest()->take(5)->get(),
        ]);
    }
}
