<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Validator;

class LanguageController extends Controller
{
   
    
    public function store(Request $request)
    {
        //
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

    public function destroy(Language $language)
    {
        //
    }
}
