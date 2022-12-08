<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendEmailScheduleJob;

class SendEmail extends Command
{
   
    protected $signature = 'send:email {email_subject} {email_template_id} {email_account}';

    protected $description = 'Broadcast email notifications';

    public function handle()
    {
        // $this->info('SMS message id is:' . $this->argument('message_id'));
        SendEmailScheduleJob::dispatch(
            $this->argument('email_subject'),
            $this->argument('email_template_id'),
            $this->argument('email_account')
            );
        return 0;
    }
}
