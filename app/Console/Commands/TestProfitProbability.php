<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ComputePlan;

class TestProfitProbability extends Command
{
    protected $signature = 'test:profit-probability';
    protected $description = 'Test profit probability distribution for all pools';

    public function handle()
    {
        $this->info('🧪 Testing Profit Probability Distribution (100 simulations per pool)');
        $this->info('Expected: 80% high profit, 20% low profit');
        $this->newLine();

        $plans = ComputePlan::all();

        foreach ($plans as $plan) {
            $this->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
            $this->info("📦 {$plan->name}");
            $this->info("💰 Investment: \${$plan->price} | Duration: " . ($plan->duration_minutes / 1440) . " days");
            $this->info("📊 Profit Range: {$plan->min_profit}% - {$plan->max_profit}% daily");
            $this->newLine();

            $highProfitCount = 0;
            $lowProfitCount = 0;
            $profits = [];

            // Run 100 simulations
            for ($i = 0; $i < 100; $i++) {
                // Simulate the probability logic
                $random = mt_rand(1, 100);
                
                if ($random <= 80) {
                    // 80% chance: upper 80% of range
                    $rangeStart = $plan->min_profit + (($plan->max_profit - $plan->min_profit) * 0.2);
                    $rangeEnd = $plan->max_profit;
                    $highProfitCount++;
                } else {
                    // 20% chance: lower 20% of range
                    $rangeStart = $plan->min_profit;
                    $rangeEnd = $plan->min_profit + (($plan->max_profit - $plan->min_profit) * 0.2);
                    $lowProfitCount++;
                }
                
                $dailyPercent = mt_rand($rangeStart * 10, $rangeEnd * 10) / 10;
                
                // Calculate profit with compound interest
                $principal = $plan->price;
                $days = $plan->duration_minutes / 1440;
                $finalAmount = $principal * pow((1 + ($dailyPercent / 100)), $days);
                $expectedProfit = round($finalAmount - $principal, 2);
                
                $profits[] = [
                    'daily_rate' => $dailyPercent,
                    'profit' => $expectedProfit,
                    'total_return' => $finalAmount,
                    'is_high' => $random <= 80
                ];
            }

            // Calculate statistics
            $minProfit = min(array_column($profits, 'profit'));
            $maxProfit = max(array_column($profits, 'profit'));
            $avgProfit = round(array_sum(array_column($profits, 'profit')) / count($profits), 2);
            
            $highProfits = array_filter($profits, fn($p) => $p['is_high']);
            $lowProfits = array_filter($profits, fn($p) => !$p['is_high']);
            
            $avgHighProfit = count($highProfits) > 0 ? round(array_sum(array_column($highProfits, 'profit')) / count($highProfits), 2) : 0;
            $avgLowProfit = count($lowProfits) > 0 ? round(array_sum(array_column($lowProfits, 'profit')) / count($lowProfits), 2) : 0;

            // Display results
            $this->info("📈 PROBABILITY DISTRIBUTION:");
            $this->line("   High Profit (80% expected): {$highProfitCount}% ✅");
            $this->line("   Low Profit (20% expected):  {$lowProfitCount}%");
            $this->newLine();

            $this->info("💵 PROFIT STATISTICS:");
            $this->line("   Minimum Profit:  \${$minProfit}");
            $this->line("   Maximum Profit:  \${$maxProfit}");
            $this->line("   Average Profit:  \${$avgProfit}");
            $this->newLine();

            $this->info("🎯 AVERAGE BY CATEGORY:");
            $this->line("   High Profit Avg: \${$avgHighProfit} (80% of users)");
            $this->line("   Low Profit Avg:  \${$avgLowProfit} (20% of users)");
            $this->newLine();

            // Show sample results
            $this->info("📋 SAMPLE RESULTS (First 5):");
            foreach (array_slice($profits, 0, 5) as $index => $profit) {
                $type = $profit['is_high'] ? '🟢 HIGH' : '🔴 LOW';
                $num = $index + 1;
                $this->line("   #{$num} {$type} | Rate: {$profit['daily_rate']}% | Profit: \${$profit['profit']} | Total: \${$profit['total_return']}");
            }
            
            $this->newLine(2);
        }

        $this->info('✅ Test completed!');
        return 0;
    }
}
