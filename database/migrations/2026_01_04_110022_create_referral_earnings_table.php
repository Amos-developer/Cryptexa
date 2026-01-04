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
        Schema::create('referral_earnings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id'); // who earned
            $table->foreignId('from_user_id'); // who caused it
            $table->decimal('amount', 12, 2);
            $table->tinyInteger('level'); // 1, 2, 3
            $table->enum('type', ['deposit', 'compute']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referral_earnings');
    }
};
