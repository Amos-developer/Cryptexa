<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\RankBonusService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PayWeeklySalaries extends Command
{
    protected $signature = 'salaries:pay-weekly';
    protected $description = 'Pay weekly salaries to Elite Leaders and above';

    public function handle()
    {
        $rankBonusService = new RankBonusService();
        $paidCount = 0;
        $totalAmount = 0;

        $users = User::where('role', '!=', 'admin')->get();

        foreach ($users as $user) {
            $rankInfo = $rankBonusService->getRankInfo($user);
            $weeklySalary = $rankInfo['weekly_salary'];

            if ($weeklySalary > 0) {
                DB::transaction(function () use ($user, $weeklySalary) {
                    $user->increment('balance', $weeklySalary);
                });

                $paidCount++;
                $totalAmount += $weeklySalary;

                $this->info("Paid ${weeklySalary} to {$user->username} ({$rankInfo['name']})");
            }
        }

        $this->info("Total: Paid ${totalAmount} to {$paidCount} users");
        return 0;
    }
}
