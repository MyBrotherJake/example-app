<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('mail:send-daily-tweet-count-mail')->everyMinute();
        /*
        // every minute
        $schedule->command('sample-command')->everyMinute();        
        // every hour
        $schedule->command('sample-command')->hourly();
        // 8 minutes per an hour
        $schedule->command('sample-command')->hourlyAt(8);
        // everyday
        $schedule->command('sample-command')->daily();
        // 13 hours everyday
        $schedule->command('sample-command')->dailyAt('13:00');
        // cron
        $schedule->command('sample-command')->cron('15 3 * * *');
        */
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
