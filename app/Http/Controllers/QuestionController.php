<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Validator;

class QuestionController extends Controller
{

    public function index()
    {
        $questions = Question::all();
        if(!$questions->isEmpty()){
            return $questions;
        }else{
            return response()->json(['Message' => 'No question created yet.']);
        }
        
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }
    
        // $qusetion = Question::create($request->all());
        $question = Question::create([
            'body' => $request->body,
            'user_id' => auth()->user()->id,
        ]);
        if ($question->exists) {
            return response()->json(['success' => 'Question created successfuly'], 200);
         } else {
            return response()->json(['error' => 'Error'], 422);
         }
    }

    public function show(Question $question)
    {
        //
    }


    public function edit(Question $question)
    {
        //
    }


    public function update(Request $request, Question $question)
    {
        //
    }


    public function destroy($id)
    {
        $question = Question::where('id',$id)->first();
        if($question){
            $question->delete();
            return response()->json(['success' => 'Question deleted successfuly'], 200);
        }else{
            return response()->json(['error' => 'Delete unsuccessful, Question not found'], 404);
        }
    }
}
