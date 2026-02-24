<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminWithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = Withdrawal::with('user')
            ->latest()
            ->paginate(20);

        return view('admin.withdrawals.index', compact('withdrawals'));
    }
    
    public function show(Withdrawal $withdrawal)
    {
        $withdrawal->load('user');
        return view('admin.withdrawals.show', compact('withdrawal'));
    }

    public function approve(Withdrawal $withdrawal)
    {
        if ($withdrawal->status !== 'pending') return back();

        $withdrawal->update([
            'status' => 'approved'
        ]);

        return back()->with('success', 'Withdrawal approved');
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
