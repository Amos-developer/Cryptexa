<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('deposits', function (Blueprint $table) {
            $table->json('provider_payload')->nullable()->after('txid');
            $table->string('provider_status_raw')->nullable()->after('provider_payload');
            $table->timestamp('processed_at')->nullable()->after('provider_status_raw');
        });
    }

    public function down()
    {
        Schema::table('deposits', function (Blueprint $table) {
            $table->dropColumn(['provider_payload', 'provider_status_raw', 'processed_at']);
        });
    }
};
