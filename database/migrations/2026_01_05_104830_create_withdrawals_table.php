<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->decimal('amount', 12, 2);
            $table->string('currency'); // USDT, BNB, etc
            $table->string('address');  // wallet address

            $table->enum('status', [
                'pending',
                'approved',
                'completed',
                'rejected'
            ])->default('pending');

            $table->string('txid')->nullable(); // blockchain tx hash
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};
