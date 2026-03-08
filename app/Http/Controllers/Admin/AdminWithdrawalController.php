<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use App\Models\User;
use App\Services\NowPaymentsPayoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminWithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = Withdrawal::with('user')
            ->latest()
            ->paginate(10);

        // Calculate stats from all withdrawals
        $totalWithdrawals = Withdrawal::where('status', 'completed')->sum('amount');
        $pendingWithdrawals = Withdrawal::where('status', 'pending')->sum('amount');
        $completedWithdrawals = Withdrawal::where('status', 'completed')->sum('amount');
        $totalRequests = Withdrawal::count();

        return view('admin.withdrawals.index', compact(
            'withdrawals',
            'totalWithdrawals',
            'pendingWithdrawals',
            'completedWithdrawals',
            'totalRequests'
        ));
    }
    
    public function create()
    {
        $users = User::orderBy('username')->get();
        return view('admin.withdrawals.create', compact('users'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string',
            'address' => 'required|string',
            'status' => 'required|in:pending,approved,completed,rejected',
            'txid' => 'nullable|string',
        ]);
        
        Withdrawal::create($validated);
        
        return redirect()->route('admin.withdrawals.index')->with('success', 'Withdrawal created successfully');
    }
    
    public function show(Withdrawal $withdrawal)
    {
        $withdrawal->load('user');
        return view('admin.withdrawals.show', compact('withdrawal'));
    }
    
    public function edit(Withdrawal $withdrawal)
    {
        $users = User::orderBy('username')->get();
        return view('admin.withdrawals.edit', compact('withdrawal', 'users'));
    }
    
    public function update(Request $request, Withdrawal $withdrawal)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string',
            'address' => 'required|string',
            'status' => 'required|in:pending,approved,completed,rejected',
            'txid' => 'nullable|string',
        ]);
        
        $withdrawal->update($validated);
        
        return redirect()->route('admin.withdrawals.index')->with('success', 'Withdrawal updated successfully');
    }

    public function approve(Request $request, Withdrawal $withdrawal)
    {
        if ($withdrawal->status !== 'pending') return back();

        $request->validate([
            'txid' => 'required|string|min:10',
        ]);

        $withdrawal->update([
            'status' => 'completed',
            'txid' => $request->txid,
        ]);

        // Create in-app notification
        \App\Models\Notification::create([
            'user_id' => $withdrawal->user_id,
            'type' => 'withdrawal_completed',
            'title' => 'Withdrawal Completed',
            'message' => 'Your withdrawal of $' . number_format($withdrawal->amount, 2) . ' has been completed. Transaction ID: ' . $request->txid,
            'icon_type' => 'success',
            'is_read' => false,
        ]);

        // Send email notification
        try {
            \Mail::send('emails.withdrawal-success', ['withdrawal' => $withdrawal], function ($message) use ($withdrawal) {
                $message->to($withdrawal->user->email)
                    ->subject('Withdrawal Completed - Cryptexa');
            });
        } catch (\Exception $e) {
            \Log::error('Failed to send withdrawal email: ' . $e->getMessage());
        }

        return back()->with('success', 'Withdrawal approved and marked as completed');
    }

    public function reject(Withdrawal $withdrawal)
    {
        if ($withdrawal->status !== 'pending') return back();

        DB::transaction(function () use ($withdrawal) {
            // refund user
            $withdrawal->user->increment('balance', $withdrawal->amount);

            $withdrawal->update([
                'status' => 'rejected'
            ]);
        });

        return back()->with('success', 'Withdrawal rejected & funds returned');
    }

    public function complete(Request $request, Withdrawal $withdrawal)
    {
        // This method is no longer needed since approve now completes the withdrawal
        return back()->with('info', 'Withdrawal is already completed');
    }
}
