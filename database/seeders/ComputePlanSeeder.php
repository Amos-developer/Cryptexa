<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ComputePlan;
use Illuminate\Support\Facades\DB;

class ComputePlanSeeder extends Seeder
{
    public function run(): void
    {
        // Optional but recommended: clear existing plans
        DB::table('compute_plans')->delete();

        ComputePlan::insert([
            [
                'name' => 'AI Node Starter',
                'type' => 'Light Inference',
                'price' => 25,
                'min_profit' => 0.9,
                'max_profit' => 1.2,
                'duration_minutes' => 2,
            ],
            [
                'name' => 'AI Node Basic',
                'type' => 'Inference Tasks',
                'price' => 50,
                'min_profit' => 1.0,
                'max_profit' => 1.3,
                'duration_minutes' => 5,
            ],
            [
                'name' => 'AI Node Pro',
                'type' => 'Model Training',
                'price' => 200,
                'min_profit' => 1.1,
                'max_profit' => 1.5,
                'duration_minutes' => 10,
            ],
            [
                'name' => 'AI Node Ultra',
                'type' => 'High GPU Load',
                'price' => 500,
                'min_profit' => 1.3,
                'max_profit' => 1.7,
                'duration_minutes' => 15,
            ],
            [
                'name' => 'AI Node Max',
                'type' => 'Enterprise Compute',
                'price' => 1000,
                'min_profit' => 1.5,
                'max_profit' => 1.8,
                'duration_minutes' => 20,
            ],
        ]);
    }
}
