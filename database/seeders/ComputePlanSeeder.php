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
                'name' => 'Bronze Vault',
                'type' => 'Crypto Accelerator',
                'price' => 50,
                'max_investment' => 499,
                'daily_profit' => 2.22,   // 2.22% daily
                'duration_minutes' => 3 * 1440, // 3 Days
                'compound_interest' => true,
            ],

            [
                'name' => 'Silver Vault',
                'type' => 'Liquidity Booster',
                'price' => 500,
                'max_investment' => 999,
                'daily_profit' => 2.65,   // 2.65% daily
                'duration_minutes' => 5 * 1440, // 5 Days
                'compound_interest' => true,
            ],

            [
                'name' => 'Gold Vault',
                'type' => 'Profit Engine',
                'price' => 1000,
                'max_investment' => 2499,
                'daily_profit' => 3.08,   // 3.08% daily
                'duration_minutes' => 7 * 1440, // 7 Days
                'compound_interest' => true,
            ],

            [
                'name' => 'Platinum Vault',
                'type' => 'Capital Maximizer',
                'price' => 2500,
                'max_investment' => 4999,
                'daily_profit' => 3.56,   // 3.56% daily
                'duration_minutes' => 10 * 1440, // 10 Days
                'compound_interest' => true,
            ],

            [
                'name' => 'Diamond Vault',
                'type' => 'Wealth Engine',
                'price' => 5000,
                'max_investment' => null,  // Unlimited (5000 to infinity)
                'daily_profit' => 4.00,    // 4.00% daily
                'duration_minutes' => 14 * 1440, // 14 Days
                'compound_interest' => true,
            ],

        ]);
    }
}
