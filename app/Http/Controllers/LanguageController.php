<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Validator;

class LanguageController extends Controller
{
   
    
    public function store(Request $request)
    {
        $rules = array(
            'language_code'         => 'required',
            'message_body'         => 'required',
            'message_id' => 'required'
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $language = new Language();

        $language->smsmessage_id = $request->message_id;
        $language->code = strtoupper($request->language_code);
        $language->message = $request->message_body;
        $language->save();

        if ($language->exists) {
            return response()->json(['success' => 'Language added successfuly'], 200);
        } else {
            return response()->json(['error' => 'Error'], 422);
        }
    }

    public function update(Request $request, Language $language)
    {
        $rules = array(
            'message_name'         => 'required',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $language = Language::where('id', $request->message_id)->first();
        $language->message = $request->message_name;
        $language->save();
        return response()->json(['success' => 'SMS message updated successfuly'], 200);
    }

    public function destroy(Request $request)
    {
        $language = Language::where('id',$request->id)->first();
        if($language){
            $language->delete();
            return response()->json(['success' => 'Deleted successfuly'], 200);
        }else{
            return response()->json(['error' => 'Delete unsuccessful'], 500);
        }
    }
}
