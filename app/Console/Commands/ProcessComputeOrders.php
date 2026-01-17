<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ComputeOrder;
use Illuminate\Support\Facades\DB;

class ProcessComputeOrders extends Command
{
    protected $signature = 'compute:process';
    protected $description = 'Process completed compute orders and credit users safely';

    public function handle()
    {
        DB::transaction(function () {

            $orders = ComputeOrder::where('status', 'running')
                ->where('ends_at', '<=', now())
                ->where('is_paid', false)
                ->lockForUpdate()
                ->get();

            foreach ($orders as $order) {

                $user = $order->user;

                // Capital + profit
                $totalReturn = $order->amount + $order->expected_profit;

                // Credit user balance ONCE
                $user->increment('balance', $totalReturn);

                // Mark order as completed & paid
                $order->update([
                    'status'  => 'completed',
                    'is_paid' => true,
                ]);
            }
        });

        $this->info('✅ Compute orders processed successfully.');

        return Command::SUCCESS;
    }
}
