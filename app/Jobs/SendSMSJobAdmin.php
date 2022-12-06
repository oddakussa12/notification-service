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

class SendSMSJobAdmin implements ShouldQueue
{
    
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, FetchUserDataTrait;

    private $is_for_all = "true";
    private $message_id;

    public function __construct(Request $request)
    {
        $this->message_id = $request->message_id;
    }

    public function handle()
    {
        $client = new \GuzzleHttp\Client();

        $user_data = $this->fetchUserDataForAll();

        try{
            foreach($user_data['data']['user'] as $hasura_user) {
                if($hasura_user['phoneNumber'] == null){
                    Log::error("User phone number is missing for user id {$hasura_user['id']}");
                    continue;
                }else{
    
                    try{
                        // get user preference language
                        $userLanguage = $hasura_user['language'];
    
                        $message = Smsmessage::find($this->message_id);
    
                        if($message){
                            $languageMessage = $message->languages()->where('code', $userLanguage)->first();
                            if($languageMessage == null){
                                $languageMessage = $message->languages()->where('code', 'EN')->first();
                            }
                        
                            $message_to_be_sent = $languageMessage->message;
    
                            $url1 = "https://kitkat.lmis.gov.et/cgi-bin/sendsms?username=lmissmsgatewayuser01&password=!QAZxsw2&coding=2&charset=utf-8&to={$hasura_user['phoneNumber']}&text={$message_to_be_sent}";
    
                            // update sms count
                            $sms_count = NotificationCount::whereDate('created_at', Carbon::today())->first();
                            if($sms_count == null){
                                Log::info("theer is no notification count created today");
                                // create new
                                $newSMS = new NotificationCount();
                                $newSMS->sms_count =  1;
                                $newSMS->save();
                            }else{
                                Log::info("theer is no notification count created today");
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
                            Log::error("There is no message with id value {$this->message_id}");
                        }
    
                    }catch(Exception $e){
                        Log::error($e);
                    }
                }
                
            }
        }catch(Exception $e){
            Log::error($e);
        }
        
    }
}
