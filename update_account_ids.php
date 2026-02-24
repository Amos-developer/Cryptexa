<?php

use Illuminate\Support\Facades\DB;

DB::table('users')->whereNull('account_id')->get()->each(function($user) {
    do {
        $accountId = str_pad(random_int(10000000, 99999999), 8, '0', STR_PAD_LEFT);
    } while (DB::table('users')->where('account_id', $accountId)->exists());
    
    DB::table('users')->where('id', $user->id)->update(['account_id' => $accountId]);
});

echo "Account IDs generated for all users.\n";
