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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('junior_leader_bonus_paid')->default(false)->after('referral_earnings');
            $table->boolean('elite_leader_bonus_paid')->default(false)->after('junior_leader_bonus_paid');
            $table->boolean('legendary_leader_bonus_paid')->default(false)->after('elite_leader_bonus_paid');
            $table->boolean('grand_leader_bonus_paid')->default(false)->after('legendary_leader_bonus_paid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['junior_leader_bonus_paid', 'elite_leader_bonus_paid', 'legendary_leader_bonus_paid', 'grand_leader_bonus_paid']);
        });
    }
};
