<?php

namespace App\Http\Controllers;

use App\Models\Smsmessage;
use App\Models\Language;
use Illuminate\Http\Request;
use Validator;

class SmsmessageController extends Controller
{
   
    public function index()
    {
        $smsMessages = Smsmessage::orderBy('created_at', 'desc')->with('languages')->get();
        return view('Admin/smsMessages',compact('smsMessages'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'message_name'         => 'required',
            'EN'         => 'required',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $message = new Smsmessage();

        $message->title = $request->message_name;
        $message->save();

        if($request->EN){
            $language = new Language();
            $language->smsmessage_id = $message->id;
            $language->code = 'EN';
            $language->message = $request->EN;
            $language->save();
        }

        if($request->AM){
            $language = new Language();
            $language->smsmessage_id = $message->id;
            $language->code = 'AM';
            $language->message = $request->AM;
            $language->save();
        }

        if ($message->exists) {
            return response()->json(['success' => 'SMS message created successfuly'], 200);
        } else {
            return response()->json(['error' => 'Error'], 422);
        }
    }

    public function update(Request $request, Smsmessage $smsmessage)
    {
        //
    }

    public function destroy(Request $request)
    {
        $message = Smsmessage::where('id',$request->id)->first();
        if($message){
            $message->delete();
            return response()->json(['success' => 'Deleted successfuly'], 200);
        }else{
            return response()->json(['error' => 'Delete unsuccessful, Message not found'], 500);
        }
    }
}
