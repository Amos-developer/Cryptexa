<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WeeklySalaryPayment;
use App\Services\RankBonusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WeeklySalaryController extends Controller
{
    public function index()
    {
        $rankBonusService = new RankBonusService();
        $eligibleUsers = [];

        $users = User::where('role', '!=', 'admin')->get();
        $startOfWeek = now()->startOfWeek();

        foreach ($users as $user) {
            $rankInfo = $rankBonusService->getRankInfo($user);
            
            if ($rankInfo['weekly_salary'] > 0) {
                $paidThisWeek = WeeklySalaryPayment::where('user_id', $user->id)
                    ->where('created_at', '>=', $startOfWeek)
                    ->exists();

                $eligibleUsers[] = [
                    'user' => $user,
                    'rank' => $rankInfo['name'],
                    'active_members' => $rankInfo['active_members'],
                    'weekly_salary' => $rankInfo['weekly_salary'],
                    'paid_this_week' => $paidThisWeek
                ];
            }
        }

        return view('admin.weekly-salary.index', compact('eligibleUsers'));
    }

    public function history()
    {
        $payments = WeeklySalaryPayment::with(['user', 'admin'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.weekly-salary.history', compact('payments'));
    }

    public function create()
    {
        $users = User::where('role', '!=', 'admin')->orderBy('username')->get();
        return view('admin.weekly-salary.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'note' => 'nullable|string|max:500'
        ]);

        $user = User::findOrFail($validated['user_id']);
        $rankBonusService = new RankBonusService();
        $rankInfo = $rankBonusService->getRankInfo($user);

        DB::transaction(function () use ($user, $validated, $rankInfo) {
            $user->increment('balance', $validated['amount']);

            WeeklySalaryPayment::create([
                'user_id' => $user->id,
                'admin_id' => auth()->id(),
                'amount' => $validated['amount'],
                'rank' => $rankInfo['name'],
                'active_members' => $rankInfo['active_members'],
                'note' => $validated['note']
            ]);
        });

        return redirect()->route('admin.weekly-salary.history')
            ->with('success', "Paid $" . number_format($validated['amount'], 2) . " to {$user->username}");
    }

    public function show(WeeklySalaryPayment $payment)
    {
        $payment->load(['user', 'admin']);
        return view('admin.weekly-salary.show', compact('payment'));
    }

    public function destroy(WeeklySalaryPayment $payment)
    {
        $username = $payment->user->username;
        $amount = $payment->amount;
        
        $payment->delete();

        return back()->with('success', "Deleted payment record of $" . number_format($amount, 2) . " to {$username}");
    }

    public function pay(Request $request, User $user)
    {
        $rankBonusService = new RankBonusService();
        $rankInfo = $rankBonusService->getRankInfo($user);
        $weeklySalary = $rankInfo['weekly_salary'];

        if ($weeklySalary <= 0) {
            return back()->with('error', 'User is not eligible for weekly salary');
        }

        // Check if already paid this week
        $startOfWeek = now()->startOfWeek();
        $alreadyPaid = WeeklySalaryPayment::where('user_id', $user->id)
            ->where('created_at', '>=', $startOfWeek)
            ->exists();

        if ($alreadyPaid) {
            return back()->with('error', "{$user->username} has already been paid this week");
        }

        DB::transaction(function () use ($user, $weeklySalary, $rankInfo) {
            $user->increment('balance', $weeklySalary);

            WeeklySalaryPayment::create([
                'user_id' => $user->id,
                'admin_id' => auth()->id(),
                'amount' => $weeklySalary,
                'rank' => $rankInfo['name'],
                'active_members' => $rankInfo['active_members'],
                'note' => 'Weekly salary payment'
            ]);
        });

        return back()->with('success', "Paid {$weeklySalary} to {$user->username}");
    }

    public function payAll(Request $request)
    {
        $rankBonusService = new RankBonusService();
        $paidCount = 0;
        $totalAmount = 0;
        $startOfWeek = now()->startOfWeek();

        $users = User::where('role', '!=', 'admin')->get();

        foreach ($users as $user) {
            $rankInfo = $rankBonusService->getRankInfo($user);
            $weeklySalary = $rankInfo['weekly_salary'];

            if ($weeklySalary > 0) {
                // Check if already paid this week
                $alreadyPaid = WeeklySalaryPayment::where('user_id', $user->id)
                    ->where('created_at', '>=', $startOfWeek)
                    ->exists();

                if (!$alreadyPaid) {
                    DB::transaction(function () use ($user, $weeklySalary, $rankInfo) {
                        $user->increment('balance', $weeklySalary);

                        WeeklySalaryPayment::create([
                            'user_id' => $user->id,
                            'admin_id' => auth()->id(),
                            'amount' => $weeklySalary,
                            'rank' => $rankInfo['name'],
                            'active_members' => $rankInfo['active_members'],
                            'note' => 'Bulk weekly salary payment'
                        ]);
                    });

                    $paidCount++;
                    $totalAmount += $weeklySalary;
                }
            }
        }

        if ($paidCount > 0) {
            return back()->with('success', "Paid {$totalAmount} to {$paidCount} users");
        } else {
            return back()->with('error', 'All eligible users have already been paid this week');
        }
    }
}
