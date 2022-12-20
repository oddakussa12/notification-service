<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Http\Traits\FetchFcmTokenTrait;

use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\NotificationCount;
use App\Models\PushNotification;


class SendPushAdminJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, FetchFcmTokenTrait;

    private $noti_id;

    
    public function __construct($noti_id)
    {
        $this->noti_id = $noti_id;
    }

   
    public function handle()
    {

        $url = env('FIREBASE_URL');
        $serverKey = env('FIREBASE_SERVER_KEY');

        $push_noti = PushNotification::where('id', $this->noti_id)->first();
        $push_language = $push_noti->pushlanguages()->where('code', 'EN')->first();
        
        $FcmToken = $this->fetchAllFCM();
       
    
        $users_fcm_token = [];

        foreach($FcmToken['data']['fcm_table'] as $token){
            $users_fcm_token[] = $token['fcm_token']; 
        }

        $data = [
            "registration_ids" => $users_fcm_token,
            "notification" => [
                "title" => $push_language->subject,
                "body" => $push_language->body,
                // "sound" => "default",
                // "icon"  => "https://www.webappfix.com/storage/app/public/site-setting/SRBx2hTgEOaHdozWVR3hgPb3LTdEw9NwajD05FL2.png"  
            ]
        ];
        $encodedData = json_encode($data);
    
        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }        
        // Close connection
        curl_close($ch);
        // FCM response
        // dd($result);
        // return response()->json(['Message' => 'Notification has been sent.', 'status_code' => '200']);
    }
}
