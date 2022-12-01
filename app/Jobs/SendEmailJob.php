<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Notifications\UserSignupNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use App\Http\Traits\FetchUserDataTrait;
use Illuminate\Queue\SerializesModels;
use App\Helpers\ConfigureEmailAccount;
use App\Models\NotificationTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Carbon\Carbon;
use App\Models\NotificationCount;

use Illuminate\Support\Facades\Log;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, FetchUserDataTrait;

    private $email;
    private $InAPP;
    private $user_id;
    private $is_for_all = "false";
    private $service_name;
    
    public function __construct(Request $request)
    {
       $this->email = $request->email;
       $this->InAPP = $request->InAPP;
       $this->user_id = $request->users['user_id'];
       $this->service_name = $request->service_name;

       if($request->email['is_for_all']){
            $this->is_for_all = $request->email['is_for_all'];
       }
    }

    public function handle()
    {
        // Log::info("Send email job handle method");

        ConfigureEmailAccount::setMailConfig($this->email['account_name']);
        $template = NotificationTemplate::where('templateId', $this->email['template_id'])->first();

        // Log::info($template);

        if($this->is_for_all == "true"){
            $user_data = $this->fetchUserDataForAll();
            return $user_data;
        }else{
            $user_data = $this->fetchUserData($this->user_id);
        }

        try{
            foreach($user_data['data']['user'] as $hasura_user) {
                if($hasura_user['email'] == null){
                    Log::error("User email is missing for user id {$hasura_user['id']} from service {$this->service_name}");
                    continue;
                }
                $user = new User();
                $user->email = $hasura_user['email'];
                $user->id = $hasura_user['id'];

                // Log::info("Thisis the user");
                // Log::info($user);
                
                Notification::sendNow($user, new UserSignupNotification(
                    $this->email['data'],
                    $template->data,
                    $this->InAPP,
                    $this->email['subject'],
                    $this->email['buttons'],
                ));

                // Log::info("noti sent");
                // update email count
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
