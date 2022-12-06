<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\NotificationTemplate;
use App\Models\Smsmessage;
use App\Models\EmailAccount;

use App\Jobs\SendEmailAdminJob;
use App\Jobs\SendSMSJobAdmin;

class NotificationController extends Controller
{
    public function index(){
        $messages = Smsmessage::orderBy('created_at', 'desc')->get();
        $emailTemplates = NotificationTemplate::orderBy('created_at', 'desc')->get();
        $emailAccounts = EmailAccount::orderBy('created_at', 'desc')->get();
        return view('Admin/adminSendNotification',compact('emailTemplates','messages', 'emailAccounts'));
    }
    public function sendNotification(Request $request){
        if($request->email_account){
            $validator = Validator::make($request->all(), [
                "email_subject" => "required",
                "email_account" => "required",
                "email_template_id" => "required"
            ]);


             if ($validator->passes()) {
                SendEmailAdminJob::dispatch($request);
             } else {
                 return response()->json(['errors' => $validator->errors()]);
             }
         }   
        if($request->message_id){
            SendSMSJobAdmin::dispatch($request);
        }
        if($request->push){

        }
        if($request->InApp){

        }

        return response()->json(['message' => "Notififcation has been sent", 'status_code' => 200]);
    }

}
