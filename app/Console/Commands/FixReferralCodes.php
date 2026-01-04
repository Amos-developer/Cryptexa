<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class FixReferralCodes extends Command
{
    protected $signature = 'referral:fix';
    protected $description = 'Convert old referral codes to 8-digit numeric codes';

    public function handle()
    {
        $users = User::whereNotNull('referral_code')->get();

        foreach ($users as $user) {
            // Skip users that already have 8-digit numeric codes
            if (preg_match('/^\d{8}$/', $user->referral_code)) {
                continue;
            }

            do {
                $newCode = rand(10000000, 99999999);
            } while (User::where('referral_code', $newCode)->exists());

            $user->update([
                'referral_code' => $newCode
            ]);

            $this->info("Updated user {$user->id} → {$newCode}");
        }

        $this->info('All referral codes fixed.');
    }
}
