<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\NotificationTemplate;
use App\Models\Smsmessage;

class NotificationController extends Controller
{
    public function index(){
        $messages = Smsmessage::orderBy('created_at', 'desc')->get();
        $emailTemplates = NotificationTemplate::orderBy('created_at', 'desc')->get();
        return view('Admin/adminSendNotification',compact('emailTemplates','messages'));
    }
    public function sendNotification(Request $request){
        return $request;
        if($request->email){

        }
        if($request->SMS){

        }
        if($request->push){

        }
        if($request->InApp){

        }
    }

}
