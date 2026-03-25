<?php

namespace App\Console\Commands;

use App\Models\ComputeOrder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ProcessDailyCompoundInterest extends Command
{
    protected $signature = 'compute:daily-compound';
    protected $description = 'Normalize projected returns for running pools';

    public function handle()
    {
        DB::transaction(function () {
            $orders = ComputeOrder::where('status', 'running')
                ->where('ends_at', '>', now())
                ->with('computePlan')
                ->get();

            foreach ($orders as $order) {
                if ($order->syncProjectedFigures()) {
                    $this->info("Fixed projected figures for order #{$order->id}.");
                }
            }
        });

        $this->info('Projected vault figures checked successfully.');

        return Command::SUCCESS;
    }
}
