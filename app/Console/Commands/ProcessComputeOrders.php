<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ComputeOrder;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

class ProcessComputeOrders extends Command
{
    protected $signature = 'compute:process';
    protected $description = 'Process completed compute orders and credit users safely';

    public function handle()
    {
        $processedCount = 0;
        
        DB::transaction(function () use (&$processedCount) {

            $orders = ComputeOrder::where('status', 'running')
                ->where('ends_at', '<=', now())
                ->where('is_paid', false)
                ->lockForUpdate()
                ->get();

            $this->info("Found {$orders->count()} orders to process");

            foreach ($orders as $order) {

                $user = $order->user;
                $balanceBefore = $user->balance;

                // Capital + profit
                $totalReturn = $order->amount + $order->expected_profit;

                // Credit user balance ONCE
                $user->increment('balance', $totalReturn);

                // Mark order as completed & paid
                $order->update([
                    'status'  => 'completed',
                    'is_paid' => true,
                ]);
                
                Notification::create([
                    'user_id' => $order->user_id,
                    'type' => 'pool_completed',
                    'title' => 'Pool Completed',
                    'message' => "Your pool has completed! Total return: $" . number_format($totalReturn, 2),
                    'icon_type' => 'success',
                    'is_read' => false,
                ]);
                
                $processedCount++;
                $this->info("✅ Order #{$order->id}: Credited \${$totalReturn} to User #{$user->id} (Balance: \${$balanceBefore} → \${$user->fresh()->balance})");
            }
        });

        if ($processedCount > 0) {
            $this->info("✅ Processed {$processedCount} orders successfully.");
        } else {
            $this->info('ℹ️  No orders to process.');
        }

        return Command::SUCCESS;
    }
}
