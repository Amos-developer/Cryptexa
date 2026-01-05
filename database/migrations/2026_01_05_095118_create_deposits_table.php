<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();

            // User relationship
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Amount user wants to deposit (USD or base currency)
            $table->decimal('amount', 16, 2);

            // Crypto info
            $table->string('currency');          // usdtbep20, usdttrc20, bnb
            $table->string('payment_id')->nullable(); // NOWPayments payment_id
            $table->string('pay_address')->nullable();
            $table->string('pay_currency')->nullable();
            $table->decimal('pay_amount', 16, 8)->nullable();

            // Blockchain info
            $table->string('txid')->nullable();

            // Status
            $table->enum('status', [
                'pending',
                'confirming',
                'completed',
                'failed',
                'expired'
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
