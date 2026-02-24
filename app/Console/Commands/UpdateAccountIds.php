<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class UpdateAccountIds extends Command
{
    protected $signature = 'users:update-account-ids';
    protected $description = 'Generate account IDs for users without one';

    public function handle()
    {
        $users = User::whereNull('account_id')->get();
        
        foreach ($users as $user) {
            do {
                $accountId = str_pad(random_int(10000000, 99999999), 8, '0', STR_PAD_LEFT);
            } while (User::where('account_id', $accountId)->exists());
            
            $user->account_id = $accountId;
            $user->save();
        }
        
        $this->info("Generated account IDs for {$users->count()} users.");
        return 0;
    }
}
