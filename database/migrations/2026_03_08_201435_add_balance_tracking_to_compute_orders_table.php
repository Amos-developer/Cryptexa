<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('compute_orders', function (Blueprint $table) {
            $table->decimal('balance_before', 12, 2)->nullable()->after('expected_profit');
            $table->decimal('balance_after', 12, 2)->nullable()->after('balance_before');
        });
    }

    public function down(): void
    {
        Schema::table('compute_orders', function (Blueprint $table) {
            $table->dropColumn(['balance_before', 'balance_after']);
        });
    }
};
