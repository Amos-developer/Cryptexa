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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('type'); // e.g., 'plan_activated', 'withdrawal_approved', 'deposit_completed'
            $table->string('title');
            $table->text('message');
            $table->string('icon_type')->default('info'); // info, success, warning, error
            $table->boolean('is_read')->default(false);
            $table->json('data')->nullable(); // Store related data like plan_id, order_id, etc.
            $table->timestamps();

            $table->index(['user_id', 'is_read']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
