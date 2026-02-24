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
            ->paginate(20);

        // Calculate stats from all withdrawals
        $totalWithdrawals = Withdrawal::whereIn('status', ['completed', 'approved'])->sum('amount');
        $pendingWithdrawals = Withdrawal::where('status', 'pending')->sum('amount');
        $approvedWithdrawals = Withdrawal::where('status', 'approved')->sum('amount');
        $totalRequests = Withdrawal::count();

        return view('admin.withdrawals.index', compact(
            'withdrawals',
            'totalWithdrawals',
            'pendingWithdrawals',
            'approvedWithdrawals',
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

    public function approve(Withdrawal $withdrawal)
    {
        if ($withdrawal->status !== 'pending') return back();

        try {
            // Extract network from currency (e.g., USDT_BEP20 -> BEP20)
            $network = str_replace('USDT_', '', $withdrawal->currency);
            $currency = NowPaymentsPayoutService::mapCurrency($network);

            // Create payout via NOWPayments
            $payoutService = new NowPaymentsPayoutService();
            $result = $payoutService->createPayout(
                $withdrawal->address,
                $withdrawal->amount,
                $currency
            );

            if ($result['success']) {
                $withdrawal->update([
                    'status' => 'approved',
                    'payout_id' => $result['id'] ?? null,
                ]);

                return back()->with('success', 'Withdrawal approved and payout initiated via NOWPayments');
            } else {
                return back()->with('error', 'Payout failed: ' . ($result['error'] ?? 'Unknown error'));
            }

        } catch (\Exception $e) {
            \Log::error('Withdrawal approval error: ' . $e->getMessage());
            return back()->with('error', 'Failed to process payout: ' . $e->getMessage());
        }
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
        if ($withdrawal->status !== 'approved') return back();

        $withdrawal->update([
            'status' => 'completed',
            'txid' => $request->txid,
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

        return back()->with('success', 'Withdrawal marked as completed');
    }
}
