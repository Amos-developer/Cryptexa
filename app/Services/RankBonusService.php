<?php

namespace App\Services;

use App\Models\User;
use App\Models\RankBonus;
use Illuminate\Support\Facades\DB;

class RankBonusService
{
    // One-time rank upgrade bonuses based on active members
    const RANK_BONUSES = [
        'junior_leader' => ['bonus' => 5, 'active_members' => 3],
        'elite_leader' => ['bonus' => 20, 'active_members' => 10],
        'legendary_leader' => ['bonus' => 50, 'active_members' => 30],
        'grand_leader' => ['bonus' => 150, 'active_members' => 100],
    ];

    public function checkAndPayRankBonuses(User $user)
    {
        $activeMembers = $this->getActiveMembers($user);
        $bonusesPaid = [];

        // Check Grand Leader
        if ($activeMembers >= 100 && !$user->grand_leader_bonus_paid) {
            $this->payBonus($user, 'grand_leader', 150);
            $bonusesPaid[] = 'Grand Leader';
        }

        // Check Legendary Leader
        if ($activeMembers >= 30 && !$user->legendary_leader_bonus_paid) {
            $this->payBonus($user, 'legendary_leader', 50);
            $bonusesPaid[] = 'Legendary Leader';
        }

        // Check Elite Leader
        if ($activeMembers >= 10 && !$user->elite_leader_bonus_paid) {
            $this->payBonus($user, 'elite_leader', 20);
            $bonusesPaid[] = 'Elite Leader';
        }

        // Check Junior Leader
        if ($activeMembers >= 3 && !$user->junior_leader_bonus_paid) {
            $this->payBonus($user, 'junior_leader', 5);
            $bonusesPaid[] = 'Junior Leader';
        }

        return $bonusesPaid;
    }

    private function getActiveMembers(User $user)
    {
        // Level 1: Direct referrals
        $level1 = User::where('referred_by', $user->id)
            ->where('role', '!=', 'admin')
            ->whereHas('deposits', fn($q) => $q->where('status', 'completed'))
            ->count();

        // Level 2
        $level1Ids = User::where('referred_by', $user->id)->where('role', '!=', 'admin')->pluck('id');
        $level2 = User::whereIn('referred_by', $level1Ids)
            ->where('role', '!=', 'admin')
            ->whereHas('deposits', fn($q) => $q->where('status', 'completed'))
            ->count();

        // Level 3
        $level2Ids = User::whereIn('referred_by', $level1Ids)->where('role', '!=', 'admin')->pluck('id');
        $level3 = User::whereIn('referred_by', $level2Ids)
            ->where('role', '!=', 'admin')
            ->whereHas('deposits', fn($q) => $q->where('status', 'completed'))
            ->count();

        return $level1 + $level2 + $level3;
    }

    private function payBonus(User $user, string $rank, float $amount)
    {
        DB::transaction(function () use ($user, $rank, $amount) {
            $balanceBefore = $user->balance;
            
            // Add bonus to user balance
            $user->increment('balance', $amount);
            
            // Mark bonus as paid
            $user->update([
                $rank . '_bonus_paid' => true
            ]);
            
            // Create rank bonus record
            RankBonus::create([
                'user_id' => $user->id,
                'rank' => ucwords(str_replace('_', ' ', $rank)),
                'bonus_amount' => $amount,
                'balance_before' => $balanceBefore,
                'balance_after' => $balanceBefore + $amount,
            ]);
        });
    }

    public function getRankInfo(User $user)
    {
        $activeMembers = $this->getActiveMembers($user);
        
        // Check actual active members first
        if ($activeMembers >= 100) {
            return ['name' => 'Grand Leader', 'weekly_salary' => 50, 'active_members' => $activeMembers];
        } elseif ($activeMembers >= 30) {
            return ['name' => 'Legendary Leader', 'weekly_salary' => 25, 'active_members' => $activeMembers];
        } elseif ($activeMembers >= 10) {
            return ['name' => 'Elite Leader', 'weekly_salary' => 10, 'active_members' => $activeMembers];
        } elseif ($activeMembers >= 3) {
            return ['name' => 'Junior Leader', 'weekly_salary' => 0, 'active_members' => $activeMembers];
        }
        
        // If no active members but bonus was paid, show last achieved rank (no salary)
        if ($user->grand_leader_bonus_paid) {
            return ['name' => 'Grand Leader (Inactive)', 'weekly_salary' => 0, 'active_members' => $activeMembers];
        } elseif ($user->legendary_leader_bonus_paid) {
            return ['name' => 'Legendary Leader (Inactive)', 'weekly_salary' => 0, 'active_members' => $activeMembers];
        } elseif ($user->elite_leader_bonus_paid) {
            return ['name' => 'Elite Leader (Inactive)', 'weekly_salary' => 0, 'active_members' => $activeMembers];
        } elseif ($user->junior_leader_bonus_paid) {
            return ['name' => 'Junior Leader (Inactive)', 'weekly_salary' => 0, 'active_members' => $activeMembers];
        }
        
        return ['name' => 'No Rank', 'weekly_salary' => 0, 'active_members' => $activeMembers];
    }
}
