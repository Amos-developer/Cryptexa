<?php

namespace App\Console\Commands;

use App\Models\Deposit;
use Illuminate\Console\Command;

class TestPaymentWebhook extends Command
{
    protected $signature = 'test:payment-webhook {deposit_id}';
    protected $description = 'Simulate payment completion for testing';

    public function handle()
    {
        $depositId = $this->argument('deposit_id');
        $deposit = Deposit::find($depositId);

        if (!$deposit) {
            $this->error("Deposit #{$depositId} not found");
            return 1;
        }

        if ($deposit->status === 'completed') {
            $this->warn("Deposit #{$depositId} already completed");
            return 0;
        }

        $this->info("Simulating payment completion for Deposit #{$depositId}");
        $this->info("User: {$deposit->user->email}");
        $this->info("Amount: \${$deposit->amount}");
        $this->info("Currency: {$deposit->currency}");

        // Update to completed
        $deposit->update([
            'status' => 'completed',
            'pay_amount' => $deposit->amount, // Simulate exact amount received
        ]);

        // Process payment
        \App\Jobs\ProcessDepositPayment::dispatch($deposit->id);

        $this->info("✓ Deposit marked as completed");
        $this->info("✓ Processing job dispatched");
        $this->info("\nRun 'php artisan queue:work' to process the job");

        return 0;
    }
}
