#!/usr/bin/env php
<?php

/**
 * Pool Logic & Calculations Test Script
 * Tests all pool investment calculations, ROI, and validation logic
 */

echo "=== POOL LOGIC & CALCULATIONS TEST ===\n\n";

// Test Data - Based on actual pool configuration
$pools = [
    [
        'id' => 11,
        'name' => 'Stable Liquidity Vault',
        'price' => 50,
        'max_investment' => 2000,
        'daily_profit' => 1.5,
        'duration_minutes' => 4320, // 3 days
    ],
    [
        'id' => 12,
        'name' => 'Strategic Growth Pool',
        'price' => 200,
        'max_investment' => 10000,
        'daily_profit' => 2.0,
        'duration_minutes' => 7200, // 5 days
    ],
    [
        'id' => 13,
        'name' => 'Advanced Capital Engine',
        'price' => 500,
        'max_investment' => 25000,
        'daily_profit' => 2.5,
        'duration_minutes' => 10080, // 7 days
    ],
    [
        'id' => 14,
        'name' => 'Prime Liquidity Reserve',
        'price' => 2000,
        'max_investment' => 100000,
        'daily_profit' => 3.0,
        'duration_minutes' => 14400, // 10 days
    ],
    [
        'id' => 15,
        'name' => 'Elite Market Advantage Pool',
        'price' => 5000,
        'max_investment' => null, // Unlimited
        'daily_profit' => 3.5,
        'duration_minutes' => 20160, // 14 days
    ],
];

// Compound Interest Formula: finalAmount = principal × (1 + dailyProfit/100)^days
function calculateCompoundInterest($principal, $dailyPercent, $days) {
    $finalAmount = $principal * pow((1 + ($dailyPercent / 100)), $days);
    $profit = $finalAmount - $principal;
    $roi = ($profit / $principal) * 100;
    
    return [
        'principal' => $principal,
        'final_amount' => $finalAmount,
        'profit' => $profit,
        'roi' => $roi,
    ];
}

// Test each pool
foreach ($pools as $pool) {
    $days = $pool['duration_minutes'] / 1440;
    
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "POOL: {$pool['name']}\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "Min Investment: $" . number_format($pool['price'], 2) . "\n";
    echo "Max Investment: " . ($pool['max_investment'] ? '$' . number_format($pool['max_investment'], 2) : 'Unlimited') . "\n";
    echo "Daily Profit: {$pool['daily_profit']}%\n";
    echo "Duration: {$days} days\n\n";
    
    // Test scenarios
    $testAmounts = [
        $pool['price'], // Minimum
        $pool['price'] * 2, // 2x minimum
        $pool['max_investment'] ?? $pool['price'] * 10, // Maximum or 10x
    ];
    
    foreach ($testAmounts as $amount) {
        // Skip if amount exceeds max
        if ($pool['max_investment'] && $amount > $pool['max_investment']) {
            continue;
        }
        
        $result = calculateCompoundInterest($amount, $pool['daily_profit'], $days);
        
        echo "  Investment: $" . number_format($amount, 2) . "\n";
        echo "  ├─ Final Amount: $" . number_format($result['final_amount'], 2) . "\n";
        echo "  ├─ Profit: $" . number_format($result['profit'], 2) . "\n";
        echo "  └─ ROI: " . number_format($result['roi'], 2) . "%\n\n";
    }
}

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "VALIDATION TESTS\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

// Test validation logic
$testCases = [
    ['pool_id' => 11, 'amount' => 25, 'should_pass' => false, 'reason' => 'Below minimum'],
    ['pool_id' => 11, 'amount' => 50, 'should_pass' => true, 'reason' => 'At minimum'],
    ['pool_id' => 11, 'amount' => 1000, 'should_pass' => true, 'reason' => 'Within range'],
    ['pool_id' => 11, 'amount' => 2000, 'should_pass' => true, 'reason' => 'At maximum'],
    ['pool_id' => 11, 'amount' => 2500, 'should_pass' => false, 'reason' => 'Above maximum'],
    ['pool_id' => 15, 'amount' => 100000, 'should_pass' => true, 'reason' => 'Unlimited pool'],
];

foreach ($testCases as $test) {
    $pool = array_values(array_filter($pools, fn($p) => $p['id'] == $test['pool_id']))[0];
    
    $isValid = $test['amount'] >= $pool['price'] && 
               ($pool['max_investment'] === null || $test['amount'] <= $pool['max_investment']);
    
    $status = $isValid === $test['should_pass'] ? '✓ PASS' : '✗ FAIL';
    $statusColor = $isValid === $test['should_pass'] ? '' : ' [ERROR]';
    
    echo "{$status}{$statusColor}: Pool {$pool['id']} - \${$test['amount']} ({$test['reason']})\n";
}

echo "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "ROI COMPARISON (All pools with $1000 investment)\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

$testAmount = 1000;
foreach ($pools as $pool) {
    if ($testAmount < $pool['price']) continue;
    if ($pool['max_investment'] && $testAmount > $pool['max_investment']) continue;
    
    $days = $pool['duration_minutes'] / 1440;
    $result = calculateCompoundInterest($testAmount, $pool['daily_profit'], $days);
    
    echo sprintf(
        "%-35s | %5.1f%% daily | %2d days | ROI: %6.2f%% | Profit: $%8.2f\n",
        $pool['name'],
        $pool['daily_profit'],
        $days,
        $result['roi'],
        $result['profit']
    );
}

echo "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "UPGRADE PATH ANALYSIS\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

$investorBalances = [500, 2500, 15000, 50000, 200000];

foreach ($investorBalances as $balance) {
    echo "Investor with $" . number_format($balance, 0) . " balance:\n";
    
    foreach ($pools as $pool) {
        if ($balance < $pool['price']) {
            echo "  ✗ {$pool['name']}: Insufficient funds\n";
            continue;
        }
        
        $maxInvestable = $pool['max_investment'] ? min($balance, $pool['max_investment']) : $balance;
        
        if ($maxInvestable < $pool['price']) {
            echo "  ✗ {$pool['name']}: Below minimum\n";
            continue;
        }
        
        $days = $pool['duration_minutes'] / 1440;
        $result = calculateCompoundInterest($maxInvestable, $pool['daily_profit'], $days);
        
        echo sprintf(
            "  ✓ %-35s | Max: $%8s | Profit: $%8.2f\n",
            $pool['name'],
            $pool['max_investment'] ? number_format($pool['max_investment'], 0) : '∞',
            $result['profit']
        );
    }
    echo "\n";
}

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "TEST COMPLETE\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
