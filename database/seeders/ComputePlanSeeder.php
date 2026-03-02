<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ComputePlan;
use Illuminate\Support\Facades\DB;

class ComputePlanSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing plans
        DB::table('compute_plans')->delete();

        ComputePlan::insert([

            [
                'name' => 'Stable Liquidity Vault',
                'type' => 'Conservative Market-Making Strategy',
                'price' => 50,
                'max_investment' => 2000,
                'daily_profit' => 2.2,   // 2.2% daily (fixed)
                'duration_minutes' => 3 * 1440, // 3 Days
                'compound_interest' => true,
            ],

            [
                'name' => 'Strategic Growth Pool',
                'type' => 'Diversified Liquidity Allocation',
                'price' => 200,
                'max_investment' => 10000,
                'daily_profit' => 2.6,   // 2.6% daily (fixed)
                'duration_minutes' => 5 * 1440, // 5 Days
                'compound_interest' => true,
            ],

            [
                'name' => 'Advanced Capital Engine',
                'type' => 'Active Liquidity Optimization',
                'price' => 500,
                'max_investment' => 25000,
                'daily_profit' => 3.0,   // 3.0% daily (fixed)
                'duration_minutes' => 7 * 1440, // 7 Days
                'compound_interest' => true,
            ],

            [
                'name' => 'Prime Liquidity Reserve',
                'type' => 'Institutional Yield Strategy',
                'price' => 2000,
                'max_investment' => 100000,
                'daily_profit' => 3.5,   // 3.5% daily (fixed)
                'duration_minutes' => 10 * 1440, // 10 Days
                'compound_interest' => true,
            ],

            [
                'name' => 'Elite Market Advantage Pool',
                'type' => 'High-Capital Liquidity Deployment',
                'price' => 5000,
                'max_investment' => null,  // Unlimited
                'daily_profit' => 3.8,   // 3.8% daily (fixed)
                'duration_minutes' => 14 * 1440, // 14 Days
                'compound_interest' => true,
            ],

        ]);
    }
}
