<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('compute_plans', function (Blueprint $table) {
            $table->decimal('min_profit', 8, 4)->change();
            $table->decimal('max_profit', 8, 4)->change();
        });
        
        // Update with correct progressive rates
        DB::table('compute_plans')->where('id', 17)->update(['min_profit' => 0.015, 'max_profit' => 0.025]);
        DB::table('compute_plans')->where('id', 19)->update(['min_profit' => 0.025, 'max_profit' => 0.035]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
