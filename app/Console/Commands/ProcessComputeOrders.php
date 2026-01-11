<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ComputeOrder;
use Illuminate\Support\Facades\DB;

class ProcessComputeOrders extends Command
{
    protected $signature = 'compute:process';
    protected $description = 'Process completed compute orders and credit users';

    public function handle()
    {
        $now = now();

        // Get running orders that expired
        $orders = ComputeOrder::where('status', 'running')
            ->where('ends_at', '<=', $now)
            ->lockForUpdate()
            ->get();

        foreach ($orders as $order) {
            DB::transaction(function () use ($order) {

                // Safety re-check inside transaction
                if ($order->status !== 'running') {
                    return;
                }

                $user = $order->user;

                // Total return = capital + profit
                $totalReturn = $order->amount + $order->expected_profit;

                // Credit user
                $user->increment('balance', $totalReturn);

                // Mark order completed
                $order->update([
                    'status' => 'completed',
                ]);
            });
        }

        return Command::SUCCESS;
    }
}
