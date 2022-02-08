<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Like;
use Illuminate\Http\Request;
use Validator;

class QuestionController extends Controller
{

    public function index()
    {
        $questions = Question::
                where('is_approved',1)
                ->where('is_rejected',0)
                ->withCount('likes')
                ->withCount('answers')
                ->with('user')
                ->get();
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
            'category_id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }
    
        // $qusetion = Question::create($request->all());
        $question = Question::create([
            'body' => $request->body,
            'category_id' => $request->category_id,
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
            $question->answers()->delete();
            $question->likes()->delete();
            return response()->json(['success' => 'Question deleted successfuly'], 200);
        }else{
            return response()->json(['error' => 'Delete unsuccessful, Question not found'], 404);
        }
    }

    public function likeQuestion(Request $request){
        $validator = Validator::make($request->all(), [
            'question_id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }
        
        $question = Question::where('id',$request->question_id)->first();
        if($question != null){
            // check if user liked the question already
            if($question->isAuthUserLikedQuestion()){
                return response()->json(['Error' => "You have already liked the question"]);
            }else{
                $like = Like::create([
                    'question_id' => $request->question_id,
                    'user_id' => auth()->user()->id,
                ]);
                if ($like->exists) {
                    return response()->json(['success' => 'You liked the question'], 200);
                 } else {
                    return response()->json(['error' => 'Error'], 422);
                 }
            }

        }else{
            return response()->json(['Error' => "The question does't exist"]);
        }
    }

    public function pinQuestion(Request $request){

    }
}
