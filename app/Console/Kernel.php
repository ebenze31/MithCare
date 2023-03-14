<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Send_Appoint_Doc::class,
        Commands\Send_Appoint_Pill::class,
        Commands\Test_delete::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
            // $schedule->command('cron:appoint')->everyTenMinutes()->withoutOverlapping(5);

            $schedule->command('cron:appoint_pill')->everyTenMinutes()->withoutOverlapping(5);
            $schedule->command('cron:appoint_doc')->dailyAt('08:00')->withoutOverlapping(10);
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
