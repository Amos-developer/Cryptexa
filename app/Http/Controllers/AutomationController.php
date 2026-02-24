<?php

namespace App\Http\Controllers;

use App\Models\ComputeOrder;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AutomationController extends Controller
{
    public function runAll()
    {
        $results = [
            'pool_completion' => $this->completeExpiredPools(),
            'compound_interest' => $this->processDailyCompound(),
            'deposit_check' => $this->checkDepositStatus(),
            'withdrawal_reminders' => $this->sendWithdrawalReminders(),
            'database_cleanup' => $this->cleanupDatabase(),
        ];

        return response()->json([
            'success' => true,
            'message' => 'All automations completed',
            'results' => $results,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }

    // 1. Auto-complete expired pools
    private function completeExpiredPools()
    {
        $completed = 0;
        
        $orders = ComputeOrder::where('status', 'running')
            ->where('ends_at', '<=', now())
            ->get();

        foreach ($orders as $order) {
            DB::transaction(function () use ($order, &$completed) {
                $totalReturn = $order->amount + $order->expected_profit;
                $order->user->increment('balance', $totalReturn);
                
                $order->update([
                    'status' => 'completed',
                    'is_paid' => true,
                ]);

                Notification::create([
                    'user_id' => $order->user_id,
                    'type' => 'pool_completed',
                    'title' => 'Pool Completed',
                    'message' => "Your pool has completed! Total return: $" . number_format($totalReturn, 2),
                    'icon_type' => 'success',
                    'is_read' => false,
                ]);

                $completed++;
            });
        }

        return ['completed' => $completed];
    }

    // 2. Process daily compound interest
    private function processDailyCompound()
    {
        $processed = 0;
        
        DB::transaction(function () use (&$processed) {
            $orders = ComputeOrder::where('status', 'running')
                ->where('ends_at', '>', now())
                ->lockForUpdate()
                ->get();

            foreach ($orders as $order) {
                $plan = $order->computePlan;
                
                if (!$plan->compound_interest) continue;

                $lastProcessed = $order->last_compound_at ?? $order->started_at;
                if ($lastProcessed->isToday()) continue;

                $dailyPercent = $order->daily_profit_percent ?? (
                    mt_rand($plan->min_profit * 10, $plan->max_profit * 10) / 10
                );

                $todayProfit = $order->amount * ($dailyPercent / 100);
                $order->amount += $todayProfit;
                $order->expected_profit += $todayProfit;
                $order->daily_profit_percent = $dailyPercent;
                $order->last_compound_at = now();
                $order->save();

                $processed++;
            }
        });

        return ['processed' => $processed];
    }

    // 3. Check deposit status (NOWPayments)
    private function checkDepositStatus()
    {
        $checked = 0;
        
        $deposits = Deposit::where('status', 'pending')
            ->where('created_at', '>=', now()->subDays(7))
            ->get();

        foreach ($deposits as $deposit) {
            // For localhost, auto-approve after 5 minutes
            if ($deposit->created_at->addMinutes(5)->isPast()) {
                DB::transaction(function () use ($deposit) {
                    $deposit->update(['status' => 'approved']);
                    $deposit->user->increment('balance', $deposit->amount);
                    
                    Notification::create([
                        'user_id' => $deposit->user_id,
                        'type' => 'deposit_approved',
                        'title' => 'Deposit Approved',
                        'message' => "Your deposit of $" . number_format($deposit->amount, 2) . " has been approved",
                        'icon_type' => 'success',
                        'is_read' => false,
                    ]);
                });
                $checked++;
            }
        }

        return ['checked' => $checked];
    }

    // 4. Send withdrawal reminders
    private function sendWithdrawalReminders()
    {
        $reminded = 0;
        
        // Auto-reject withdrawals pending for more than 7 days
        $oldWithdrawals = Withdrawal::where('status', 'pending')
            ->where('created_at', '<=', now()->subDays(7))
            ->get();

        foreach ($oldWithdrawals as $withdrawal) {
            DB::transaction(function () use ($withdrawal) {
                $withdrawal->update(['status' => 'rejected']);
                $withdrawal->user->increment('balance', $withdrawal->amount);
                
                Notification::create([
                    'user_id' => $withdrawal->user_id,
                    'type' => 'withdrawal_rejected',
                    'title' => 'Withdrawal Expired',
                    'message' => "Your withdrawal request has expired and funds have been refunded",
                    'icon_type' => 'warning',
                    'is_read' => false,
                ]);
            });
            $reminded++;
        }

        return ['reminded' => $reminded];
    }

    // 5. Database cleanup
    private function cleanupDatabase()
    {
        $cleaned = 0;
        
        // Archive old notifications
        $cleaned += Notification::where('created_at', '<=', now()->subDays(30))
            ->where('is_read', true)
            ->delete();

        // Remove unverified users older than 7 days
        $cleaned += User::whereNull('email_verified_at')
            ->where('created_at', '<=', now()->subDays(7))
            ->delete();

        return ['cleaned' => $cleaned];
    }
}
