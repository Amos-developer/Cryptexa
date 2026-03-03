<?php

// Test calculations for all vault plans

$plans = [
    ['name' => 'Bronze Vault', 'daily_profit' => 2.22, 'days' => 3, 'investment' => 100],
    ['name' => 'Silver Vault', 'daily_profit' => 2.65, 'days' => 5, 'investment' => 1000],
    ['name' => 'Gold Vault', 'daily_profit' => 3.08, 'days' => 7, 'investment' => 5000],
    ['name' => 'Platinum Vault', 'daily_profit' => 3.56, 'days' => 10, 'investment' => 20000],
    ['name' => 'Diamond Vault', 'daily_profit' => 4.00, 'days' => 14, 'investment' => 100000],
];

echo "=== VAULT CALCULATION TESTS ===\n\n";

foreach ($plans as $plan) {
    $principal = $plan['investment'];
    $dailyPercent = $plan['daily_profit'];
    $days = $plan['days'];
    
    // Compound interest formula: Final = Principal × (1 + rate)^days
    $finalAmount = $principal * pow((1 + ($dailyPercent / 100)), $days);
    $expectedProfit = round($finalAmount - $principal, 2);
    $totalReturn = $finalAmount;
    $roi = (($finalAmount - $principal) / $principal) * 100;
    
    echo "{$plan['name']}\n";
    echo "  Daily Rate: {$dailyPercent}%\n";
    echo "  Duration: {$days} days\n";
    echo "  Investment: $" . number_format($principal, 2) . "\n";
    echo "  Final Amount: $" . number_format($finalAmount, 2) . "\n";
    echo "  Expected Profit: $" . number_format($expectedProfit, 2) . "\n";
    echo "  Total ROI: " . number_format($roi, 2) . "%\n";
    echo "\n";
}

echo "=== FORMULA VERIFICATION ===\n";
echo "Formula: Final = Principal × (1 + (daily_profit / 100))^days\n";
echo "Example: $100 × (1.0222)^3 = $" . number_format(100 * pow(1.0222, 3), 2) . "\n";
