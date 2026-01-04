<?php

namespace App\Http\Controllers;
use App\Models\Deposit;
use App\Services\ReferralService;
use Illuminate\Support\Facades\DB;
use App\Models\User;

use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function showQrCode()
    {
        return view('qr-code');
    }

    public function store(Request $request, ReferralService $referralService)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1'
        ]);

        DB::transaction(function () use ($request, $referralService) {

            $deposit = Deposit::create([
                'user_id' => auth()->id(),
                'amount' => $request->amount,
                'status' => 'completed',
            ]);

            $user = auth()->user();

            $user->increment('balance', $deposit->amount);

            // 🔥 Referral Deposit Bonus
            $referralService->handleDepositBonus($user, $deposit->amount);
        });

        return back()->with('success', 'Deposit successful');
    }
}
