<?php

namespace App\Http\Controllers;

use App\Models\Emaillanguage;
use Illuminate\Http\Request;
use Validator;

class EmaillanguageController extends Controller
{
    public function store(Request $request)
    {
        $rules = array(
            'email_template_id'         => 'required',
            'language_code'         => 'required',
            'email_body' => 'required'
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $language = new Emaillanguage();

        $language->notification_template_id = $request->email_template_id;
        $language->code = strtoupper($request->language_code);
        $language->body = $request->email_body;
        $language->save();

        if ($language->exists) {
            return response()->json(['success' => 'Language added successfuly'], 200);
        } else {
            return response()->json(['error' => 'Error'], 422);
        }
    }

    public function update(Request $request, Emaillanguage $language)
    {
        $rules = array(
            'id'         => 'required',
            'language_code'         => 'required',
            'email_body' => 'required'
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $language = Emaillanguage::where('id', $request->id)->first();
        $language->code = $request->language_code;
        $language->body = $request->email_body;
        $language->save();
        return response()->json(['success' => 'Data updated successfuly'], 200);
    }

    public function destroy(Request $request)
    {
        $language = Emaillanguage::where('id',$request->id)->first();
        if($language){
            $language->delete();
            return response()->json(['success' => 'Deleted successfuly'], 200);
        }else{
            return response()->json(['error' => 'Delete unsuccessful'], 500);
        }
    }
}
