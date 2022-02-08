<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public function approveQuestion(Request $request){
        $question = Question::where('id',$request->id)->first();
        if($question != null){
            $question->is_approved = 1;
            $question->is_rejected = 0;
            $question->save();
            return response()->json(["Message" => "Question approved successfully"],200);
        }else{
            return response()->json(['Error' => "Question not found"]);
        } 
    }
    public function declineQuestion(Request $request){
        $question = Question::where('id',$request->id)->first();
        if($question != null){
            $question->is_rejected = 1;
            $question->is_approved = 0;
            $question->save();
            return response()->json(["Message" => "Question rejected successfully"],200);
        }else{
            return response()->json(['Error' => "Question not found"]);
        } 
    }
}
