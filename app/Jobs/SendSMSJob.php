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
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

use GuzzleHttp\Client;

class SendSMSJob implements ShouldQueue
{
    
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, FetchUserDataTrait;

    private $SMS;
    private $user_id;
    private $is_for_all = "false";
    private $service_name;
    private $message_id;
    private $variables;

    public function __construct(Request $request)
    {
        $this->SMS = $request->SMS;
        $this->variables = $request->SMS['varialbles'];
        $this->user_id = $request->users['user_id'];
        $this->service_name = $request->service_name;
        $this->message_id = $request->SMS['message_id'];

        if($request->SMS['is_for_all']){
            $this->is_for_all = $request->SMS['is_for_all'];
       }
    }

    public function handle()
    {
        $client = new \GuzzleHttp\Client();

        if($this->is_for_all == "true"){
            $user_data = $this->fetchUserDataForAll();
        }else{
            $user_data = $this->fetchUserData($this->user_id);
        }

        foreach($user_data['data']['user'] as $hasura_user) {
            if($hasura_user['phoneNumber'] == null){
                Log::error("User phone number is missing for user id {$hasura_user['id']} from service {$this->service_name}");
                continue;
            }else{

                try{
                    // get user preference language
                    $userLanguage = $hasura_user['language'];

                    $message = Smsmessage::find($this->message_id);

                    if($message){
                        $languageMessage = $message->languages()->where('code', $userLanguage)->first();
                        if($languageMessage == null){
                            // Log::info("This language is not defined in users prefered language");
                            $languageMessage = $message->languages()->where('code', 'EN')->first();
                        }
                    
                        $message_to_be_sent = $languageMessage->message;

                        foreach ($this->variables as $variable) {
                            $search_by = $variable['label'];
                            $replace_value = $variable['value'];

                            $message_to_be_sent = str_replace("$search_by", $replace_value, $message_to_be_sent);
                        }   
                        // $url1 = "https://kitkat.lmis.gov.et/cgi-bin/sendsms?username=lmissmsgatewayuser01&password=!QAZxsw2&coding=2&charset=utf-8&to={$hasura_user['phoneNumber']}&text={$this->SMS['message']}";
                        $url1 = "https://kitkat.lmis.gov.et/cgi-bin/sendsms?username=lmissmsgatewayuser01&password=!QAZxsw2&coding=2&charset=utf-8&to={$hasura_user['phoneNumber']}&text={$message_to_be_sent}";

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
    }
}
