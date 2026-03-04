<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Update Bronze Vault
        DB::table('compute_plans')
            ->where('name', 'Bronze Vault')
            ->update([
                'price' => 50,
                'max_investment' => 499,
            ]);

        // Update Silver Vault
        DB::table('compute_plans')
            ->where('name', 'Silver Vault')
            ->update([
                'price' => 500,
                'max_investment' => 999,
            ]);

        // Update Gold Vault
        DB::table('compute_plans')
            ->where('name', 'Gold Vault')
            ->update([
                'price' => 1000,
                'max_investment' => 2499,
            ]);

        // Update Platinum Vault
        DB::table('compute_plans')
            ->where('name', 'Platinum Vault')
            ->update([
                'price' => 2500,
                'max_investment' => 4999,
            ]);

        // Update Diamond Vault
        DB::table('compute_plans')
            ->where('name', 'Diamond Vault')
            ->update([
                'price' => 5000,
                'max_investment' => null,
            ]);
    }

    public function down(): void
    {
        // Revert to old values
        DB::table('compute_plans')
            ->where('name', 'Bronze Vault')
            ->update([
                'price' => 50,
                'max_investment' => 500,
            ]);

        DB::table('compute_plans')
            ->where('name', 'Silver Vault')
            ->update([
                'price' => 501,
                'max_investment' => 2000,
            ]);

        DB::table('compute_plans')
            ->where('name', 'Gold Vault')
            ->update([
                'price' => 2001,
                'max_investment' => 10000,
            ]);

        DB::table('compute_plans')
            ->where('name', 'Platinum Vault')
            ->update([
                'price' => 10001,
                'max_investment' => 50000,
            ]);

        DB::table('compute_plans')
            ->where('name', 'Diamond Vault')
            ->update([
                'price' => 50001,
                'max_investment' => null,
            ]);
    }
};
