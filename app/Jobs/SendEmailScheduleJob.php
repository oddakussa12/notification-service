<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

use App\Helpers\ConfigureEmailAccount;
use App\Models\NotificationTemplate;
use App\Http\Traits\FetchUserDataTrait;
use App\Notifications\AdminEmailNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

use Illuminate\Support\Facades\Log;

use Exception;
use Carbon\Carbon;
use App\Models\NotificationCount;

class SendEmailScheduleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, FetchUserDataTrait;

    private $subject;
    private $template_id;
    private $email_account;
   
    public function __construct($email_subject, $email_template_id, $email_account)
    {
        $this->subject = $email_subject;
        $this->template_id = $email_template_id;
        $this->email_account = $email_account;
    }

    public function handle()
    {
        ConfigureEmailAccount::setMailConfig($this->email_account);
        $template = NotificationTemplate::where('templateId', $this->template_id)->first();

        $user_data = $this->fetchUserDataForAll();

        try{
            foreach($user_data['data']['user'] as $hasura_user) {
                if($hasura_user['email'] == null){
                    Log::error("User email is missing for user id {$hasura_user['id']}");
                    continue;
                }
                $user = new User();
                $user->email = $hasura_user['email'];
                $user->id = $hasura_user['id'];
                
                Notification::sendNow($user, new AdminEmailNotification(
                    $template->data,
                    $this->subject
                ));

                $email_count = NotificationCount::whereDate('created_at', Carbon::today())->first();
                if($email_count == null){
                    // create new
                    $newEmail = new NotificationCount();
                    $newEmail->email_count =  1;
                    $newEmail->save();
                }else{
                    // update count value
                    $email_count->email_count = $email_count->email_count +1;
                    $email_count->save();
                }
            }
        }catch(Exception $e){

        }
    }
}
