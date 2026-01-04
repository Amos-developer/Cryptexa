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
        Schema::table('deposits', function (Blueprint $table) {
            $table->string('currency')->nullable();          // usdtbep20, bnb, etc
            $table->string('payment_id')->nullable();        // NOWPayments ID
            $table->string('pay_address')->nullable();       // wallet address
            $table->string('pay_currency')->nullable();      // crypto currency
            $table->decimal('pay_amount', 16, 8)->nullable(); // crypto amount
            $table->string('txid')->nullable();              // blockchain tx
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nowpayments');
    }
};
