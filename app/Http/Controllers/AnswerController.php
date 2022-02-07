<?php

namespace App\Http\Controllers;

use App\Models\Answer;
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

    public function update(Request $request, Answer $answer)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required',
            'question_id' => 'required',
            'answer_id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }

        $question = Question::where('id',$request->question_id)->first();
        if($question != null){
            $answer = Answer::where('id',$request->answer_id)->first();
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
        }else{
            return response()->json(['error' => 'question with the given id is not found'], 422);
        }

    }


    public function destroy(Answer $answer)
    {
        //
    }
}
