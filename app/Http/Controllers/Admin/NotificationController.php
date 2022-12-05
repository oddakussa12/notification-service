<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        return view('Admin/adminSendNotification');
    }
    public function sendNotification(Request $request){

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
