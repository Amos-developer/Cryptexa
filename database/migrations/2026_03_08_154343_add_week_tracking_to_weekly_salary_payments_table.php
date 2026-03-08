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
        Schema::table('weekly_salary_payments', function (Blueprint $table) {
            $table->integer('week_number')->after('active_members');
            $table->integer('year')->after('week_number');
            $table->boolean('is_auto_paid')->default(false)->after('year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('weekly_salary_payments', function (Blueprint $table) {
            $table->dropColumn(['week_number', 'year', 'is_auto_paid']);
        });
    }
};
