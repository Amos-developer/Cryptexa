<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\ComputePlan;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'totalUsers' => User::where('role', '!=', 'admin')->count(),
            'totalPools' => ComputePlan::count(),
            'totalDeposits' => Deposit::where('status', 'completed')->sum('amount'),
            'totalWithdrawals' => Withdrawal::whereIn('status', ['completed', 'approved'])->sum('amount'),
            'totalPendingDeposits' => Deposit::whereIn('status', ['pending', 'confirming', 'waiting'])->sum('amount'),
            'totalPendingWithdrawals' => Withdrawal::where('status', 'pending')->sum('amount'),
            'newUsersToday' => User::where('role', '!=', 'admin')->whereDate('created_at', today())->count(),
            'completedDeposits' => Deposit::where('status', 'completed')->count(),
            'pendingDeposits' => Deposit::whereIn('status', ['pending', 'confirming'])->count(),
            'pendingWithdrawals' => Withdrawal::where('status', 'pending')->count(),
            'recentUsers' => User::where('role', '!=', 'admin')->latest()->take(5)->get(),
            'recentDeposits' => Deposit::with('user')->latest()->take(5)->get(),
            'recentPools' => ComputePlan::latest()->take(5)->get(),
            'recentWithdrawals' => Withdrawal::with('user')->latest()->take(5)->get(),
        ]);
    }
}
