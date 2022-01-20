<?php

namespace App\Http\Controllers;

use App\Models\AutoReply;
use Illuminate\Http\Request;
use Validator;


class AutoReplyController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $rules = array(
            'triggerMessage' => 'required',
            'responseMessage' => 'required',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $form_data = array(
            'trigger' => $request->triggerMessage,
            'response' => $request->responseMessage
        ); 
        AutoReply::create($form_data);
        return response()->json(['success'=> 'New rule added successfully.']); 
    }

    public function show(AutoReply $autoReply)
    {
        //
    }

   
    public function edit(AutoReply $autoReply)
    {
        //
    }

    public function update(Request $request, AutoReply $autoReply)
    {
        //
    }

    public function destroy(AutoReply $autoReply)
    {
        //
    }
}
