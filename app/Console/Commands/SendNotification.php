<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendNotification extends Command
{
   
    protected $signature = 'send:notification';

    protected $description = 'Broadcast notifications.';

    public function handle()
    {
        return Command::SUCCESS;
        // $this->info('Notification has been sent.');
        
    }
}
