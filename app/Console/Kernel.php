<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Register the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Process completed compute orders every minute
        $schedule->command('compute:process')
            ->everyMinute()
            ->withoutOverlapping()
            ->onOneServer();

        // Run all automations every 5 minutes
        $schedule->command('automation:run')
            ->everyFiveMinutes()
            ->withoutOverlapping()
            ->onOneServer()
            ->runInBackground();

        // Pay weekly salaries every Monday at 00:00
        $schedule->command('salaries:pay-weekly')
            ->weekly()
            ->mondays()
            ->at('00:00')
            ->withoutOverlapping()
            ->onOneServer();


    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
