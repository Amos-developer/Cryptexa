<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ComputePlan;

class ComputePlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ComputePlan::insert([
            [
                'name' => 'AI Node Starter',
                'type' => 'Light Inference',
                'price' => 25,
                'min_profit' => 2,
                'max_profit' => 3,
                'duration_minutes' => 120,
            ],
            [
                'name' => 'AI Node Basic',
                'type' => 'Inference Tasks',
                'price' => 50,
                'min_profit' => 4,
                'max_profit' => 6,
                'duration_minutes' => 240,
            ],
            [
                'name' => 'AI Node Pro',
                'type' => 'Model Training',
                'price' => 200,
                'min_profit' => 24,
                'max_profit' => 30,
                'duration_minutes' => 720,
            ],
            [
                'name' => 'AI Node Ultra',
                'type' => 'High GPU Load',
                'price' => 500,
                'min_profit' => 70,
                'max_profit' => 85,
                'duration_minutes' => 1080,
            ],
            [
                'name' => 'AI Node Max',
                'type' => 'Enterprise Compute',
                'price' => 1000,
                'min_profit' => 160,
                'max_profit' => 190,
                'duration_minutes' => 1440,
            ],
        ]);
    }
}
