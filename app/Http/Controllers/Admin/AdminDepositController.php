<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminDepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::with('user')->latest()->paginate(20);
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
        
        $deposit = Deposit::create($validated);
        
        // If status is completed, update user balance and send email
        if ($deposit->status === 'completed') {
            $user = User::find($deposit->user_id);
            $user->balance += $deposit->amount;
            $user->save();
            
            try {
                Mail::send('emails.deposit-success', ['deposit' => $deposit, 'user' => $user], function($message) use ($user) {
                    $message->to($user->email)->subject('Deposit Successful');
                });
            } catch (\Exception $e) {
                \Log::error('Failed to send deposit email: ' . $e->getMessage());
            }
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
        $oldAmount = $deposit->amount;
        $oldUserId = $deposit->user_id;
        
        $deposit->update($validated);
        
        // Handle balance changes
        if ($oldStatus !== 'completed' && $deposit->status === 'completed') {
            // Status changed to completed - add to balance
            $user = User::find($deposit->user_id);
            $user->balance += $deposit->amount;
            $user->save();
            
            try {
                Mail::send('emails.deposit-success', ['deposit' => $deposit, 'user' => $user], function($message) use ($user) {
                    $message->to($user->email)->subject('Deposit Successful');
                });
            } catch (\Exception $e) {
                \Log::error('Failed to send deposit email: ' . $e->getMessage());
            }
        } elseif ($oldStatus === 'completed' && $deposit->status !== 'completed') {
            // Status changed from completed - remove from balance
            $user = User::find($oldUserId);
            $user->balance -= $oldAmount;
            $user->save();
        } elseif ($oldStatus === 'completed' && $deposit->status === 'completed') {
            // Both completed but amount or user changed
            if ($oldUserId !== $deposit->user_id || $oldAmount !== $deposit->amount) {
                // Remove from old user
                $oldUser = User::find($oldUserId);
                $oldUser->balance -= $oldAmount;
                $oldUser->save();
                
                // Add to new user
                $newUser = User::find($deposit->user_id);
                $newUser->balance += $deposit->amount;
                $newUser->save();
            }
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
