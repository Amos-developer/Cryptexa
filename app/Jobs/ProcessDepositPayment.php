<?php

namespace App\Jobs;

use App\Models\Deposit;
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

            // Credit user
            $deposit->user->increment('balance', $deposit->amount);

            // Pay referral bonuses
            $levels = [0.16, 0.08, 0.04, 0.02, 0.01, 0.005];
            $referrer = $deposit->user->referrer;

            foreach ($levels as $rate) {
                if (!$referrer) break;

                $bonus = round($deposit->amount * $rate, 2);
                $referrer->increment('balance', $bonus);
                $referrer->increment('referral_earnings', $bonus);

                $referrer = $referrer->referrer;
            }

            // Mark as processed
            $deposit->processed_at = now();
            $deposit->save();

            logger()->info('ProcessDepositPayment: completed', ['deposit_id' => $deposit->id]);
        });
    }
}
