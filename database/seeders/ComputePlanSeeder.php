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
                'min_profit' => 1.0,   // 1% daily
                'max_profit' => 2.0,   // 2% daily
                'duration_minutes' => 3 * 1440, // 3 Days
                'compound_interest' => true,
            ],

            [
                'name' => 'Strategic Growth Pool',
                'type' => 'Diversified Liquidity Allocation',
                'price' => 200,
                'min_profit' => 1.5,   // 1.5% daily
                'max_profit' => 2.5,   // 2.5% daily
                'duration_minutes' => 5 * 1440, // 5 Days
                'compound_interest' => true,
            ],

            [
                'name' => 'Advanced Capital Engine',
                'type' => 'Active Liquidity Optimization',
                'price' => 500,
                'min_profit' => 2.0,   // 2% daily
                'max_profit' => 3.0,   // 3% daily
                'duration_minutes' => 7 * 1440, // 7 Days
                'compound_interest' => true,
            ],

            [
                'name' => 'Prime Liquidity Reserve',
                'type' => 'Institutional Yield Strategy',
                'price' => 2000,
                'min_profit' => 2.5,   // 2.5% daily
                'max_profit' => 3.5,   // 3.5% daily
                'duration_minutes' => 10 * 1440, // 10 Days
                'compound_interest' => true,
            ],

            [
                'name' => 'Elite Market Advantage Pool',
                'type' => 'High-Capital Liquidity Deployment',
                'price' => 5000,
                'min_profit' => 3.0,   // 3% daily
                'max_profit' => 4.0,   // 4% daily
                'duration_minutes' => 14 * 1440, // 14 Days
                'compound_interest' => true,
            ],

        ]);
    }
}
