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
                'min_profit' => 0.9,   // 0.9% daily
                'max_profit' => 1.2,   // 1.2% daily
                'duration_minutes' => 3 * 1440, // 3 Days
            ],

            [
                'name' => 'Strategic Growth Pool',
                'type' => 'Diversified Liquidity Allocation',
                'price' => 200,
                'min_profit' => 1.2,
                'max_profit' => 1.6,
                'duration_minutes' => 5 * 1440, // 5 Days
            ],

            [
                'name' => 'Advanced Capital Engine',
                'type' => 'Active Liquidity Optimization',
                'price' => 500,
                'min_profit' => 1.5,
                'max_profit' => 1.9,
                'duration_minutes' => 7 * 1440, // 7 Days
            ],

            [
                'name' => 'Prime Liquidity Reserve',
                'type' => 'Institutional Yield Strategy',
                'price' => 2000,
                'min_profit' => 1.8,
                'max_profit' => 2.1,
                'duration_minutes' => 10 * 1440, // 10 Days
            ],

            [
                'name' => 'Elite Market Advantage Pool',
                'type' => 'High-Capital Liquidity Deployment',
                'price' => 5000,
                'min_profit' => 2.0,
                'max_profit' => 2.3,
                'duration_minutes' => 14 * 1440, // 14 Days
            ],

        ]);
    }
}
