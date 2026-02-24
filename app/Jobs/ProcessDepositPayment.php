<?php

namespace App\Jobs;

use App\Models\Deposit;
use App\Models\ReferralEarning;
use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ProcessDepositPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $depositId;

    public function __construct(int $depositId)
    {
        $this->depositId = $depositId;
    }

    public function handle()
    {
        // Re-load and lock the deposit so concurrent jobs don't double-process it
        DB::transaction(function () {
            $deposit = Deposit::where('id', $this->depositId)->lockForUpdate()->first();

            if (!$deposit) {
                logger()->warning('ProcessDepositPayment: deposit not found', ['id' => $this->depositId]);
                return;
            }

            // Only process if status is completed and not already processed
            if ($deposit->status !== 'completed' || $deposit->processed_at) {
                logger()->info('ProcessDepositPayment: skipping (not completed or already processed)', ['id' => $deposit->id, 'status' => $deposit->status, 'processed_at' => $deposit->processed_at]);
                return;
            }

            // Credit user EXACT amount deposited (use pay_amount if available, otherwise amount)
            $creditAmount = $deposit->pay_amount ?? $deposit->amount;
            $deposit->user->increment('balance', $creditAmount);
            
            logger()->info('ProcessDepositPayment: credited user', [
                'user_id' => $deposit->user_id,
                'amount' => $creditAmount,
                'deposit_id' => $deposit->id,
            ]);

            // Pay referral commissions (3 levels)
            $commissions = [
                1 => 0.02,  // 2%
                2 => 0.01,  // 1%
                3 => 0.005, // 0.5%
            ];

            $referrer = $deposit->user->referrer;
            $level = 1;

            while ($referrer && $level <= 3) {
                // Calculate commission on actual deposited amount
                $commission = round($creditAmount * $commissions[$level], 2);

                // Credit commission instantly
                $referrer->increment('balance', $commission);
                $referrer->increment('referral_earnings', $commission);

                // Record the earning
                ReferralEarning::create([
                    'user_id' => $referrer->id,
                    'from_user_id' => $deposit->user_id,
                    'amount' => $commission,
                    'level' => $level,
                    'type' => 'deposit',
                ]);

                // Create notification
                Notification::create([
                    'user_id' => $referrer->id,
                    'type' => 'referral_commission',
                    'title' => 'Referral Commission Earned',
                    'message' => "You earned $" . number_format($commission, 2) . " commission from Level {$level} referral deposit.",
                    'icon_type' => 'success',
                    'is_read' => false,
                ]);

                $referrer = $referrer->referrer;
                $level++;
            }

            // Mark as processed
            $deposit->processed_at = now();
            $deposit->save();

            logger()->info('ProcessDepositPayment: completed', ['deposit_id' => $deposit->id]);
        });
    }
}
