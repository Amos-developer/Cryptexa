<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use Illuminate\Http\Request;

class AdminDepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::with('user')->latest()->paginate(20);
        $users = \App\Models\User::all();
        $totalDeposits = Deposit::where('status', 'completed')->sum('amount');
        $pendingDeposits = Deposit::whereIn('status', ['pending', 'confirming'])->sum('amount');
        $todayDeposits = Deposit::whereDate('created_at', today())->where('status', 'completed')->sum('amount');
        
        return view('admin.deposits.index', compact('deposits', 'users', 'totalDeposits', 'pendingDeposits', 'todayDeposits'));
    }
    
    public function show(Deposit $deposit)
    {
        $deposit->load('user');
        return view('admin.deposits.show', compact('deposit'));
    }
    
    public function approve(Deposit $deposit)
    {
        if ($deposit->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending deposits can be approved');
        }
        
        $deposit->update(['status' => 'completed']);
        
        // Process deposit payment
        \App\Jobs\ProcessDepositPayment::dispatch($deposit->id);
        
        return redirect()->back()->with('success', 'Deposit approved and processed');
    }
}
