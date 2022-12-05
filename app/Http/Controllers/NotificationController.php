<?php

namespace App\Http\Controllers;

use App\Jobs\SendPushNotificationJob;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Jobs\SendEmailJob;
use App\Jobs\SendSMSJob;
use App\Models\User;
use Validator;
use Auth;

use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{

    public function sendNotification(Request $request){

        if($request->email){
            $validator = Validator::make($request->all(), [
                "users" => "required",
            ]);

            if ($validator->passes()) {
                SendEmailJob::dispatch($request);

            } else {
                return response()->json(['errors' => $validator->errors()]);
            }
        }

        if($request->SMS){

            $validator = Validator::make($request->all(), [
                // "message" => "required|string",
                "users" => "required",
            ]);

            if ($validator->passes()) {
                SendSMSJob::dispatch($request);
            } else {
                return response()->json(['errors' => $validator->errors()]);
            }
        }

        if($request->push){
            $validator = Validator::make($request->all(), [
                "users" => "required"
            ]);

            if ($validator->passes()) {
                SendPushNotificationJob::dispatch($request);
            } else {
                return response()->json(['errors' => $validator->errors()]);
            }
        }

        return response()->json(['message' => "Notififcation has been sent", 'status_code' => 200]);
    }

    public function markNotificationAsRead(Request $request){
        $user = new User();
        $user->id = $request->user_id;
        $notifications = $user->unreadNotifications->whereIn('id',$request->notification_ids)->markAsRead();
        return "pis";
    }

    public function markAllNotificationsAsRead(Request $request){
        $user = new User();
        $user->id = $request->user_id;
        $user->unreadNotifications->markAsRead();
        return "ok";
    }

    

    public function updateDeviceToken(Request $request)
    {
        Auth::user()->device_token =  $request->token;

        Auth::user()->save();

        return response()->json(['Token successfully stored.']);

    }

    public function sendTestPushNotification(Request $request)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $FcmToken = User::whereNotNull('device_token')->pluck('device_token')->all();
            
        $serverKey = 'AAAALrAwb1k:APA91bErnN6XPauxcl0AWNgQo3OOQ0tYOIijGkkXOa4wFg8ZZWGAmbZRUoPZdoTz1m79kzzxP2wih4odNGB3WXK3-nLq2AkBsileCFIFsVyRrObNLlpS8OjbEODX5TP_C3jde-_DyYsy'; // ADD SERVER KEY HERE PROVIDED BY FCM
    
        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
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
        dd($result);
    
    }

    public function userNotification($user_id){
        $notifications = Notification::where('notifiable_id',$user_id)->get();
        return $notifications;
    }
}  