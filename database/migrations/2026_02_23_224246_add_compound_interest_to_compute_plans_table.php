<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('compute_plans', function (Blueprint $table) {
            $table->boolean('compound_interest')->default(true)->after('max_profit');
        });
    }

    public function down(): void
    {
        Schema::table('compute_plans', function (Blueprint $table) {
            $table->dropColumn('compound_interest');
        });
    }
};
