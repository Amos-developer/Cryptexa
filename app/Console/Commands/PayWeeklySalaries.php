<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\WeeklySalaryPayment;
use App\Services\RankBonusService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PayWeeklySalaries extends Command
{
    protected $signature = 'salaries:pay-weekly';
    protected $description = 'Pay weekly salaries to Elite Leaders and above';

    public function handle()
    {
        $now = Carbon::now();
        $weekNumber = $now->week;
        $year = $now->year;
        
        $this->info("Processing weekly salaries for Week {$weekNumber}, {$year}");
        
        $rankBonusService = new RankBonusService();
        $paidCount = 0;
        $totalAmount = 0;
        $skippedCount = 0;

        $users = User::where('role', '!=', 'admin')->get();

        foreach ($users as $user) {
            $rankInfo = $rankBonusService->getRankInfo($user);
            $weeklySalary = $rankInfo['weekly_salary'];

            if ($weeklySalary > 0) {
                // Check if already paid for this week
                $alreadyPaid = WeeklySalaryPayment::where('user_id', $user->id)
                    ->where('week_number', $weekNumber)
                    ->where('year', $year)
                    ->exists();
                
                if ($alreadyPaid) {
                    $this->warn("Skipped {$user->username} - Already paid for this week");
                    $skippedCount++;
                    continue;
                }
                
                DB::transaction(function () use ($user, $weeklySalary, $rankInfo, $weekNumber, $year) {
                    $user->increment('balance', $weeklySalary);
                    
                    WeeklySalaryPayment::create([
                        'user_id' => $user->id,
                        'admin_id' => 1, // System auto-payment
                        'amount' => $weeklySalary,
                        'rank' => $rankInfo['name'],
                        'active_members' => $rankInfo['active_members'],
                        'week_number' => $weekNumber,
                        'year' => $year,
                        'is_auto_paid' => true,
                        'note' => 'Automatic weekly salary payment'
                    ]);
                });

                $paidCount++;
                $totalAmount += $weeklySalary;

                $this->info("Paid ${weeklySalary} to {$user->username} ({$rankInfo['name']})");
            }
        }

        $this->info("\nSummary:");
        $this->info("- Paid: {$paidCount} users");
        $this->info("- Skipped: {$skippedCount} users (already paid)");
        $this->info("- Total Amount: ${totalAmount}");
        
        return 0;
    }
}
