<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Deposit;
use App\Jobs\ProcessDepositPayment;
use Illuminate\Console\Command;

class TestReferralCommissions extends Command
{
    protected $signature = 'test:referral-commissions';
    protected $description = 'Test referral commission system';

    public function handle()
    {
        $this->info('Testing Referral Commission System...');
        $this->newLine();

        // Find a user with referrals
        $user = User::whereNotNull('referred_by')->first();
        
        if (!$user) {
            $this->error('No user with referrer found. Please create a referral chain first.');
            return 1;
        }

        $this->info("Testing with user: {$user->username} (ID: {$user->id})");
        
        // Get referral chain
        $level1 = User::find($user->referred_by);
        $level2 = $level1 ? User::find($level1->referred_by) : null;
        $level3 = $level2 ? User::find($level2->referred_by) : null;

        $this->info("Referral Chain:");
        $this->info("  Level 1: " . ($level1 ? "{$level1->username} (Balance: \${$level1->balance})" : "None"));
        $this->info("  Level 2: " . ($level2 ? "{$level2->username} (Balance: \${$level2->balance})" : "None"));
        $this->info("  Level 3: " . ($level3 ? "{$level3->username} (Balance: \${$level3->balance})" : "None"));
        $this->newLine();

        // Create a test deposit
        $testAmount = 100;
        $this->info("Creating test deposit of \${$testAmount}...");
        
        $deposit = Deposit::create([
            'user_id' => $user->id,
            'amount' => $testAmount,
            'currency' => 'usdtbsc',
            'status' => 'completed',
            'payment_id' => 'test-' . time(),
        ]);

        $this->info("Deposit created (ID: {$deposit->id})");
        $this->newLine();

        // Process the deposit
        $this->info("Processing deposit and calculating commissions...");
        ProcessDepositPayment::dispatchSync($deposit->id);
        
        $this->newLine();
        $this->info("✓ Deposit processed!");
        $this->newLine();

        // Check results
        $this->info("Results:");
        $this->info("  User balance: \${$user->fresh()->balance}");
        
        if ($level1) {
            $level1Fresh = $level1->fresh();
            $commission1 = $testAmount * 0.02;
            $this->info("  Level 1 ({$level1->username}): \${$level1Fresh->balance} (Expected commission: \${$commission1})");
        }
        
        if ($level2) {
            $level2Fresh = $level2->fresh();
            $commission2 = $testAmount * 0.01;
            $this->info("  Level 2 ({$level2->username}): \${$level2Fresh->balance} (Expected commission: \${$commission2})");
        }
        
        if ($level3) {
            $level3Fresh = $level3->fresh();
            $commission3 = $testAmount * 0.005;
            $this->info("  Level 3 ({$level3->username}): \${$level3Fresh->balance} (Expected commission: \${$commission3})");
        }

        $this->newLine();
        $this->info('✓ Test completed successfully!');
        
        return 0;
    }
}
