<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InappNotification;
use App\Models\InappLanguage;
use Validator;

class InappNotificationController extends Controller
{
    public function index()
    {
        $inapp_notifications = InappNotification::orderBy('created_at', 'desc')->with('inappLanguages')->get();
        return view('Admin/inapp_notifications',compact('inapp_notifications'));
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

        $notification = new InappNotification();

        $notification->title = $request->title;

        if($request->description){
            $notification->description = $request->description;
        }

        $notification->save();

        $language = new InappLanguage();

        $language->inapp_notification_id = $notification->id;
        $language->code = 'EN';
        $language->subject = $request->en_title;
        $language->body = $request->en_body;

        $language->save();

        if ($notification->exists) {
            return response()->json(['success' => 'In app notification created successfuly'], 200);
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

        $notification = InappNotification::where('id', $request->notification_id)->first();
        $notification->title = $request->edit_title;

        if($request->edit_description){
            $notification->description = $request->edit_description;
        }
        $notification->save();
        return response()->json(['success' => 'Updated successfuly'], 200);

    }

    public function destroy(Request $request)
    {
        $notification = InappNotification::where('id',$request->id)->first();
        if($notification){
            $notification->inappLanguages()->delete();
            $notification->delete();

            return response()->json(['success' => 'Deleted successfuly'], 200);
        }else{
            return response()->json(['error' => 'Delete unsuccessful, Item not found'], 500);
        }
    }
}
