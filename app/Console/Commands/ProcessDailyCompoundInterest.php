<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ComputeOrder;
use Illuminate\Support\Facades\DB;

class ProcessDailyCompoundInterest extends Command
{
    protected $signature = 'compute:daily-compound';
    protected $description = 'Process daily compound interest for running pools';

    public function handle()
    {
        DB::transaction(function () {
            $orders = ComputeOrder::where('status', 'running')
                ->where('ends_at', '>', now())
                ->lockForUpdate()
                ->get();

            foreach ($orders as $order) {
                $plan = $order->computePlan;
                
                // Skip if not compound interest
                if (!$plan->compound_interest) {
                    continue;
                }

                // Calculate days since start
                $daysSinceStart = now()->diffInDays($order->started_at);
                
                // Only process if at least 1 day has passed
                if ($daysSinceStart < 1) {
                    continue;
                }

                // Check if we already processed today
                $lastProcessed = $order->last_compound_at ?? $order->started_at;
                if ($lastProcessed->isToday()) {
                    continue;
                }

                // Get daily profit percentage (stored as percentage like 1.5, not decimal)
                $dailyPercent = $order->daily_profit_percent ?? (
                    mt_rand($plan->min_profit * 10, $plan->max_profit * 10) / 10
                );

                // Calculate today's profit on current amount (convert percentage to decimal)
                $todayProfit = $order->amount * ($dailyPercent / 100);

                // Add profit to principal (compound)
                $order->amount += $todayProfit;
                $order->expected_profit += $todayProfit;
                $order->daily_profit_percent = $dailyPercent;
                $order->last_compound_at = now();
                $order->save();

                $this->info("✅ Compounded {$order->id}: +${$todayProfit}");
            }
        });

        $this->info('✅ Daily compound interest processed successfully.');
        return Command::SUCCESS;
    }
}
