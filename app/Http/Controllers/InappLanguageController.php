<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\InappLanguage;

class InappLanguageController extends Controller
{
    public function store(Request $request)
    {
        $rules = array(
            'notificationid' => 'required',
            'language_code'         => 'required',
            'body'         => 'required',
            'title'         => 'required',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $language = new InappLanguage();

        $language->inapp_notification_id = $request->notificationid;
        $language->code = strtoupper($request->language_code);
        $language->subject = $request->title;
        $language->body = $request->body;
        $language->save();

        if ($language->exists) {
            return response()->json(['success' => 'Language added successfuly'], 200);
        } else {
            return response()->json(['error' => 'Error'], 422);
        }
    }

    public function update(Request $request)
    {
        $rules = array(
            'edit_notificationid'         => 'required',
            'edit_language_code'         => 'required',
            'edit_title'         => 'required',
            'edit_body'         => 'required',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $language = InappLanguage::where('id', $request->edit_notificationid)->first();
        $language->code = $request->edit_language_code;
        $language->subject = $request->edit_title;
        $language->body = $request->edit_body;
        $language->save();
        return response()->json(['success' => 'Data updated successfuly'], 200);
    }

    public function destroy(Request $request)
    {
        $language = InappLanguage::where('id',$request->id)->first();
        if($language){
            $language->delete();
            return response()->json(['success' => 'Deleted successfuly'], 200);
        }else{
            return response()->json(['error' => 'Delete unsuccessful'], 500);
        }
    }
}
