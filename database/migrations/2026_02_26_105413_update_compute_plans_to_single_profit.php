<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('compute_plans', function (Blueprint $table) {
            // Add new daily_profit column
            $table->decimal('daily_profit', 5, 2)->after('price')->default(0);
        });
        
        // Migrate existing data: daily_profit = (min_profit + max_profit) / 2
        DB::statement('UPDATE compute_plans SET daily_profit = (min_profit + max_profit) / 2');
        
        Schema::table('compute_plans', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn(['min_profit', 'max_profit']);
        });
    }

    public function down(): void
    {
        Schema::table('compute_plans', function (Blueprint $table) {
            // Restore old columns
            $table->decimal('min_profit', 5, 2)->after('price')->default(0);
            $table->decimal('max_profit', 5, 2)->after('min_profit')->default(0);
            
            // Drop new column
            $table->dropColumn('daily_profit');
        });
    }
};
