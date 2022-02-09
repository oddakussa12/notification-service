<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Answerlike;
use App\Models\Dislikeanswer;
use App\Models\Question;
use Illuminate\Http\Request;
use Validator;

class AnswerController extends Controller
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
            'question_id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }
        
        $question = Question::where('id',$request->question_id)->first();
        if($question){
            $answer = Answer::create([
                'body' => $request->body,
                'question_id' => $request->question_id,
                'user_id' => auth()->user()->id,
            ]);
            if ($question->exists) {
                return response()->json(['success' => 'Answer added successfuly'], 200);
             } else {
                return response()->json(['error' => 'Error'], 422);
             }
        }else{
            return response()->json(['error' => 'question with the given id is not found'], 422);
        }
        
    }

    public function show(Answer $answer)
    {
        //
    }

    public function edit(Answer $answer)
    {
        //
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }
        $answer = Answer::where('id',$id)->first();
        if($answer != null){
            // check the updator is the owner of the answer
            if($answer->user_id == auth()->user()->id){
                $answer->body = $request->body;
                $answer->save();
                return response()->json(['success' => 'Answer updated successfuly'], 200);
            }else{
                return response()->json(['Not allowed' => 'you are not the owner of the answer'], 422);
            }
        }else{
            return response()->json(['error' => 'Answer with the given id is not found'], 422);
        }
    }


    public function destroy(Answer $answer,$id)
    {
        $answer = Answer::where('id',$id)->first();
        if($answer){
            if($answer->user_id == auth()->user()->id){
                $answer->delete();
                // $answer->replies()->delete();
                // $answer->likes()->delete();
                // $answer->dislikes()->delete();
                return response()->json(['success' => 'Answer deleted successfuly'], 200);
            }else{
                return response()->json(['Error' => 'You can not delete this answer']);
            }
        }else{
            return response()->json(['error' => 'Delete unsuccessful, answer not found'], 404);
        }
    }

    public function likeAnswer(Request $request){
        $validator = Validator::make($request->all(), [
            'answer_id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }
        
        $answer = Answer::where('id',$request->answer_id)->first();
        if($answer != null){
            // check if user liked the question already
            if($answer->isAuthUserLikedAnswer()){
                return response()->json(['Error' => "You have already liked the answer"]);
            }else{
                $answerlike = Answerlike::create([
                    'answer_id' => $request->answer_id,
                    'user_id' => auth()->user()->id,
                ]);
                if ($answerlike->exists) {
                    return response()->json(['success' => 'You liked the answer'], 200);
                 } else {
                    return response()->json(['error' => 'Error'], 422);
                 }
            }

        }else{
            return response()->json(['Error' => "The answer does't exist"]);
        }
    }

    public function dislikeAnswer(Request $request){
        $validator = Validator::make($request->all(), [
            'answer_id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }
        
        $answer = Answer::where('id',$request->answer_id)->first();
        if($answer != null){
            // check if user liked the question already
            if($answer->isAuthUserDislikedAnswer()){
                return response()->json(['Error' => "You have already disliked the answer"]);
            }else{
                $answerdislike = Dislikeanswer::create([
                    'answer_id' => $request->answer_id,
                    'user_id' => auth()->user()->id,
                ]);
                if ($answerdislike->exists) {
                    return response()->json(['success' => 'You disliked the answer'], 200);
                 } else {
                    return response()->json(['error' => 'Error'], 422);
                 }
            }

        }else{
            return response()->json(['Error' => "The answer does't exist"]);
        }
    }
}
