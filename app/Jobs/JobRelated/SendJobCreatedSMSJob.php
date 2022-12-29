<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Traits\FetchUserDataTrait;
use Illuminate\Http\Request;
use App\Models\Smsmessage;
use App\Models\NotificationCount;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

use GuzzleHttp\Client;
use Carbon\Carbon;

class SendJobCreatedSMSJob implements ShouldQueue
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
        $client = new \GuzzleHttp\Client();
        
        $user_data = $this->fetchUserData($this->user_id);

        foreach($user_data['data']['user'] as $hasura_user) {
            if($hasura_user['phoneNumber'] == null){
                Log::error("User phone number is missing for user id {$hasura_user['id']} from service {$this->service_name}");
                continue;
            }else{

                try{
                    // get user preference language
                    $userLanguage = $hasura_user['language'];

                    $message = Smsmessage::find(2);

                    if($message){
                        $languageMessage = $message->languages()->where('code', $userLanguage)->first();
                        if($languageMessage == null){
                            $languageMessage = $message->languages()->where('code', 'EN')->first();
                        }
                    
                        $message_to_be_sent = $languageMessage->message;
                        $strrings = implode(", ",$this->tags);
                        
                        $message_to_be_sent = str_replace("tags", $strrings, $message_to_be_sent);

                        // $url1 = "https://kitkat.lmis.gov.et/cgi-bin/sendsms?username=lmissmsgatewayuser01&password=!QAZxsw2&coding=2&charset=utf-8&to={$hasura_user['phoneNumber']}&text={$this->SMS['message']}";
                        $url1 = "https://kitkat.lmis.gov.et/cgi-bin/sendsms?username=lmissmsgatewayuser01&password=!QAZxsw2&coding=2&charset=utf-8&to={$hasura_user['phoneNumber']}&text={$message_to_be_sent}";

                        // update sms count
                        $sms_count = NotificationCount::whereDate('created_at', Carbon::today())->first();
                        if($sms_count == null){
                            // create new
                            $newSMS = new NotificationCount();
                            $newSMS->sms_count =  1;
                            $newSMS->save();
                        }else{
                            // update count value
                            $sms_count->sms_count = $sms_count->sms_count +1;
                            $sms_count->save();
                        }
                        
                        $url1 = preg_replace("/ /", "%20", $url1); 
                        $response = $client->get($url1, [
                    
                        ]);
                        
                        // echo $url1;
                        echo $response->getBody();
                        
                    }else{
                        Log::error("There is no message with given id value");
                    }

                }catch(Exception $e){
                    Log::error($e);
                }
            }
            
        }
    }
}
