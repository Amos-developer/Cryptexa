<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('registration_ip', 45)->nullable()->after('notification_preferences');
            $table->text('registration_user_agent')->nullable()->after('registration_ip');
            $table->string('last_login_ip', 45)->nullable()->after('registration_user_agent');
            $table->text('last_login_user_agent')->nullable()->after('last_login_ip');
            $table->timestamp('last_login_at')->nullable()->after('last_login_user_agent');
        });

        Schema::create('user_access_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('event', 32);
            $table->string('ip_address', 45)->nullable()->index();
            $table->text('user_agent')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_access_logs');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'registration_ip',
                'registration_user_agent',
                'last_login_ip',
                'last_login_user_agent',
                'last_login_at',
            ]);
        });
    }
};
