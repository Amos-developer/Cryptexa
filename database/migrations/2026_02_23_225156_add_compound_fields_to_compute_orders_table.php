<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('compute_orders', function (Blueprint $table) {
            $table->decimal('daily_profit_percent', 8, 2)->nullable()->after('expected_profit');
            $table->timestamp('last_compound_at')->nullable()->after('ends_at');
        });
    }

    public function down(): void
    {
        Schema::table('compute_orders', function (Blueprint $table) {
            $table->dropColumn(['daily_profit_percent', 'last_compound_at']);
        });
    }
};
