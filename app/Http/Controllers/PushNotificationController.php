<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PushNotification;
use App\Models\PushLanguage;
use Validator;

class PushNotificationController extends Controller
{
    public function index()
    {
        $push_notifications = PushNotification::orderBy('created_at', 'desc')->with('pushlanguages')->get();
        return view('Admin/push_notifications',compact('push_notifications'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'title'         => 'required',
            'en_title'      => 'required',
            'en_body'         => 'required',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $notification = new PushNotification();

        $notification->title = $request->title;

        if($request->description){
            $notification->description = $request->description;
        }

        $notification->save();

        $language = new PushLanguage();

        $language->push_notification_id = $notification->id;
        $language->code = 'EN';
        $language->subject = $request->en_title;
        $language->body = $request->en_body;

        $language->save();

        if ($notification->exists) {
            return response()->json(['success' => 'Push notification created successfuly'], 200);
        } else {
            return response()->json(['error' => 'Error'], 422);
        }
    }

    public function update(Request $request)
    {
        $rules = array(
            'edit_title'         => 'required',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $notification = PushNotification::where('id', $request->notification_id)->first();
        $notification->title = $request->edit_title;

        if($request->edit_description){
            $notification->description = $request->edit_description;
        }
        $notification->save();
        return response()->json(['success' => 'Updated successfuly'], 200);

    }

    public function destroy(Request $request)
    {
        $notification = PushNotification::where('id',$request->id)->first();
        if($notification){
            $notification->pushlanguages()->delete();
            $notification->delete();

            return response()->json(['success' => 'Deleted successfuly'], 200);
        }else{
            return response()->json(['error' => 'Delete unsuccessful, Item not found'], 500);
        }
    }
}
