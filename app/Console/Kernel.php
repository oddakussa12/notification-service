<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        Commands\SendSMS::class,
        Commands\SendEmail::class,
    ];

   
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('send:notification')
        //         ->everyMinute();
        // $schedule->command('send:sms');
        // ->everyMinute();
        // $schedule->job(new SendSMSJobAdmin)->everyMinute();

        // $schedule->call(function () {
        //     //
        // })->weekly()->mondays()->at('13:00');
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
