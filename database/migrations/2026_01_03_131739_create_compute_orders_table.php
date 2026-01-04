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
        Schema::create('compute_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('compute_plan_id')->constrained()->cascadeOnDelete();

            $table->decimal('amount', 12, 2);
            $table->decimal('expected_profit', 12, 2);

            $table->timestamp('started_at')->nullable();
            $table->timestamp('ends_at')->nullable();


            $table->enum('status', ['running', 'completed'])->default('running');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compute_orders');
    }
};
