<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendEmailAdminJob;

class SendNotification extends Command
{
   
    protected $signature = 'send:notification {email_subject} {initialDate} {finalDate}';

    protected $description = 'Broadcast notifications.';

    public function handle()
    {
        // return Command::SUCCESS;
        // $this->info('Notification has been sent.');

        $this->info('Subject of the email is:' . $this->argument('email_subject'));
        $this->info("Send email at: " . $this->argument('initialDate'));
        $this->info("Stop sending this email at: " . $this->argument('finalDate'));
        return 0;
        
    }
}
