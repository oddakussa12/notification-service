<?php

namespace App\Jobs\JobRelated;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Traits\FetchUserDataTrait;
use Illuminate\Http\Request;
use App\Models\NotificationTemplate;
use App\Models\NotificationCount;
use Illuminate\Support\Facades\Notification;
use App\Notifications\JobPreferenceNotification;
use App\Helpers\ConfigureEmailAccount;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\User;

use GuzzleHttp\Client;
use Carbon\Carbon;

class SendJobCreatedEmailJob implements ShouldQueue
{
    
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, FetchUserDataTrait;

    private $user_id, $tags;

    public function __construct($user_id, $tags)
    {
        $this->user_id = $user_id;
        $this->tags = $tags;
    }

    public function handle()
    {
        
        $user_data = $this->fetchUserData($this->user_id);
        ConfigureEmailAccount::setMailConfig("OTP-Email");
        


        foreach($user_data['data']['user'] as $hasura_user) {
            if($hasura_user['email'] == null){
                Log::error("User email is missing for user id {$hasura_user['id']}");
                continue;
            }else{

                try{                   
                    $template = NotificationTemplate::where('id', 1)->first();
                    
                    if($template){
                        $userLanguage = $hasura_user['language'];

                        $emailLanguage = $template->emaillanguages()->where('code', $userLanguage)->first();

                        if($emailLanguage == null){
                            $emailLanguage = $template->emaillanguages()->where('code', 'EN')->first();
                        }
                       

                        $user = new User();
                        $user->email = $hasura_user['email'];
                        $user->id = $hasura_user['id'];

                        Notification::sendNow($user, new JobPreferenceNotification(
                            $this->tags,
                            $emailLanguage->body,
                            $hasura_user['name']
                        ));
        
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
                        
                    }else{
                        Log::error("There is no email template with given id value");
                    }

                }catch(Exception $e){
                    Log::error($e);
                }
            }
        }
    }
}
