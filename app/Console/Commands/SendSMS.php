<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendSMSJobAdmin;
use App\Jobs\SendSmsScheduleJob;

class SendSMS extends Command
{
   
    protected $signature = 'send:sms {message_id}';

    protected $description = 'Schedule to send SMS notifications by admin.';

    public function handle()
    {
        // return Command::SUCCESS;
        $this->info('SMS message id is:' . $this->argument('message_id'));
        SendSmsScheduleJob::dispatch($this->argument('message_id'));
        return 0;
    }
}
