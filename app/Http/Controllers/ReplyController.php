<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Answer;
use Illuminate\Http\Request;
use Validator;

class ReplyController extends Controller
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
        $validator = Validator::make($request->all(), [
            'body' => 'required',
            'answer_id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }
        
        $answer = Answer::where('id',$request->answer_id)->first();
        if($answer){
            $reply = Reply::create([
                'body' => $request->body,
                'answer_id' => $request->answer_id,
                'user_id' => auth()->user()->id,
            ]);
            if ($answer->exists) {
                return response()->json(['success' => 'Reply added successfuly'], 200);
             } else {
                return response()->json(['error' => 'Error'], 422);
             }
        }else{
            return response()->json(['error' => 'Answer with the given id is not found'], 422);
        }
    }

    public function show(Reply $reply)
    {
        //
    }

 
    public function edit(Reply $reply)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }
        $reply = Reply::where('id',$id)->first();
        if($reply != null){
            // check the updator is the owner of the reply
            if($reply->user_id == auth()->user()->id){
                $reply->body = $request->body;
                $reply->save();
                return response()->json(['success' => 'Reply updated successfuly'], 200);
            }else{
                return response()->json(['Not allowed' => 'you are not the owner of the reply'], 422);
            }
        }else{
            return response()->json(['error' => 'Reply with the given id is not found'], 422);
        }
    }

    public function destroy(Reply $reply,$id)
    {
        $reply = Reply::where('id',$id)->first();
        if($reply){
            if($reply->user_id == auth()->user()->id){
                $reply->delete();
                // $reply->replyLikes()->delete();
                // $reply->replyDislikes()->delete();
                return response()->json(['success' => 'Reply deleted successfuly'], 200);
            }else{
                return response()->json(['Error' => 'You can not delete this reply']);
            }
        }else{
            return response()->json(['error' => 'Delete unsuccessful, Reply not found'], 404);
        }
    }
}
