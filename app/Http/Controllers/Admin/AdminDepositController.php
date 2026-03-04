<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminDepositController extends Controller
{
    public function index(Request $request)
    {
        $query = Deposit::with('user');
        
        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }
        
        $deposits = $query->latest()->paginate(20)->withQueryString();
        $users = User::all();
        $totalDeposits = Deposit::where('status', 'completed')->sum('amount');
        $pendingDeposits = Deposit::whereIn('status', ['pending', 'confirming'])->sum('amount');
        $todayDeposits = Deposit::whereDate('created_at', today())->where('status', 'completed')->sum('amount');
        
        return view('admin.deposits.index', compact('deposits', 'users', 'totalDeposits', 'pendingDeposits', 'todayDeposits'));
    }
    
    public function create()
    {
        $users = User::orderBy('username')->get();
        return view('admin.deposits.create', compact('users'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string',
            'status' => 'required|in:pending,waiting,confirming,completed,failed',
            'payment_id' => 'nullable|string',
            'txid' => 'nullable|string',
        ]);
        
        $deposit = Deposit::create(array_merge($validated, [
            'pay_amount' => $validated['amount'], // Set pay_amount to match amount for manual deposits
        ]));
        
        // If status is completed, process deposit immediately (balance + referral commissions)
        if ($deposit->status === 'completed') {
            \App\Jobs\ProcessDepositPayment::dispatchSync($deposit->id);
        }
        
        return redirect()->route('admin.deposits.index')->with('success', 'Deposit created successfully');
    }
    
    public function show(Deposit $deposit)
    {
        $deposit->load('user');
        return view('admin.deposits.show', compact('deposit'));
    }
    
    public function edit(Deposit $deposit)
    {
        $users = User::orderBy('username')->get();
        return view('admin.deposits.edit', compact('deposit', 'users'));
    }
    
    public function update(Request $request, Deposit $deposit)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string',
            'status' => 'required|in:pending,waiting,confirming,completed,failed',
            'payment_id' => 'nullable|string',
            'txid' => 'nullable|string',
        ]);
        
        $oldStatus = $deposit->status;
        $wasProcessed = $deposit->processed_at !== null;
        
        // Reset processed_at if status changes from completed
        if ($oldStatus === 'completed' && $validated['status'] !== 'completed') {
            $deposit->processed_at = null;
        }
        
        $deposit->update($validated);
        
        // If status changed to completed and not yet processed, process immediately
        if ($deposit->status === 'completed' && !$wasProcessed) {
            \App\Jobs\ProcessDepositPayment::dispatchSync($deposit->id);
        }
        
        return redirect()->route('admin.deposits.index')->with('success', 'Deposit updated successfully');
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
