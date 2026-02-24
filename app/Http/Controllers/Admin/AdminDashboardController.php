<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Deposit;
use App\Models\Withdrawal;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'totalUsers' => User::count(),
            'totalDeposits' => Deposit::where('status', 'completed')->sum('amount'),
            'pendingDeposits' => Deposit::whereIn('status', ['pending', 'confirming'])->count(),
            'pendingWithdrawals' => Withdrawal::where('status', 'pending')->count(),
            'recentUsers' => User::latest()->take(5)->get(),
            'recentDeposits' => Deposit::with('user')->latest()->take(5)->get(),
            'recentWithdrawals' => Withdrawal::with('user')->latest()->take(5)->get(),
        ]);
    }
}
