<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Jobs\SendEmailAdminJob;
use App\Jobs\SendSMSJobAdmin;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    // private $time;

    // public function __construct($time)
    // {
    //     $this->time = $time;
    // }

    protected $commands = [
        Commands\SendNotification::class,
    ];

   
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('send:notification')
        //         ->everyMinute();
        $schedule->job(new SendSMSJobAdmin)->everyMinute();

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
