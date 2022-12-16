<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Http\Traits\FetchUserDataTrait;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\NotificationCount;
use App\Models\InappNotification;
use App\Notifications\AdminInappNotification;

class SendInappAdminJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, FetchUserDataTrait;

    private $noti_id;

    
    public function __construct($noti_id)
    {
        $this->noti_id = $noti_id;
    }

    public function handle()
    {
        $user_data = $this->fetchUserDataForAll();
        $inapp_noti = InappNotification::where('id', $this->noti_id)->first();

        try{
            foreach($user_data['data']['user'] as $hasura_user) {
                if($hasura_user['email'] == null){
                    Log::error("User id {$hasura_user['id']} is missing");
                    continue;
                }
                $user = new User();
                $user->id = $hasura_user['id'];

                // get user preference language
                $userLanguage = $hasura_user['language'];

                $notificationLanguage = $inapp_noti->inappLanguages()->where('code', $userLanguage)->first();

                if($notificationLanguage == null){
                    // Log::info("This language is not defined in users prefered language");
                    $notificationLanguage = $inapp_noti->inappLanguages()->where('code', 'EN')->first();
                }
                
                Notification::sendNow($user, new AdminInappNotification(
                    $notificationLanguage->subject,
                    $notificationLanguage->body,
                ));

                // Log::info("noti sent");
                // update email count
                // $email_count = NotificationCount::whereDate('created_at', Carbon::today())->first();
                // if($email_count == null){
                //     // create new
                //     $newEmail = new NotificationCount();
                //     $newEmail->email_count =  1;
                //     $newEmail->save();
                // }else{
                //     // update count value
                //     $email_count->email_count = $email_count->email_count +1;
                //     $email_count->save();
                // }
            }
        }catch(Exception $e){

        }
    }
}
