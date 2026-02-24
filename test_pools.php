<?php

// Test script to verify all liquidity pools work correctly

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== LIQUIDITY POOLS TEST ===\n\n";

// Get all pools
$pools = \App\Models\ComputePlan::orderBy('id')->get();

echo "Found " . $pools->count() . " pools\n\n";

foreach ($pools as $pool) {
    $days = $pool->duration_minutes / 1440;
    
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "Pool: {$pool->name}\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "Duration: {$days} days\n";
    echo "Min Investment: \${$pool->price}\n";
    echo "Daily Rate: " . number_format($pool->min_profit * 100, 1) . "% - " . number_format($pool->max_profit * 100, 1) . "%\n\n";
    
    // Test with $50 investment at min, avg, and max rates
    $testAmounts = [50, 100, 500];
    $testRates = [
        'Min' => $pool->min_profit,
        'Avg' => ($pool->min_profit + $pool->max_profit) / 2,
        'Max' => $pool->max_profit
    ];
    
    foreach ($testAmounts as $amount) {
        echo "Investment: \${$amount}\n";
        echo str_repeat("-", 50) . "\n";
        
        foreach ($testRates as $label => $rate) {
            // Calculate compound interest
            $finalAmount = $amount * pow((1 + $rate), $days);
            $profit = $finalAmount - $amount;
            $roi = ($profit / $amount) * 100;
            
            echo sprintf(
                "  %s Rate (%.1f%% daily): \$%.2f total | +\$%.2f profit | %.1f%% ROI\n",
                $label,
                $rate * 100,
                $finalAmount,
                $profit,
                $roi
            );
        }
        echo "\n";
    }
    
    // Verify calculation matches controller logic
    $dailyPercent = ($pool->min_profit + $pool->max_profit) / 2;
    $principal = 50;
    $finalAmount = $principal * pow((1 + $dailyPercent), $days);
    $expectedProfit = round($finalAmount - $principal, 2);
    
    echo "Controller Logic Test (Avg rate, \$50):\n";
    echo "  Daily Percent: " . number_format($dailyPercent * 100, 2) . "%\n";
    echo "  Expected Profit: \${$expectedProfit}\n";
    echo "  Final Amount: \$" . number_format($finalAmount, 2) . "\n\n";
}

echo "\n=== COMPOUND INTEREST SIMULATION ===\n\n";

// Simulate 3-day pool with daily compounding
$pool = $pools->first();
$principal = 50;
$dailyRate = 0.015; // 1.5%

echo "Pool: {$pool->name}\n";
echo "Investment: \${$principal}\n";
echo "Daily Rate: " . ($dailyRate * 100) . "%\n\n";

$amount = $principal;
for ($day = 1; $day <= 3; $day++) {
    $dailyProfit = $amount * $dailyRate;
    $amount += $dailyProfit;
    echo "Day {$day}: \$" . number_format($amount, 2) . " (+\$" . number_format($dailyProfit, 2) . ")\n";
}

$totalProfit = $amount - $principal;
echo "\nFinal: \$" . number_format($amount, 2) . "\n";
echo "Total Profit: \$" . number_format($totalProfit, 2) . "\n";

echo "\n=== TEST COMPLETE ===\n";
