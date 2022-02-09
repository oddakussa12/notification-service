<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Like;
use App\Models\Category;
use Illuminate\Http\Request;
use Validator;

class QuestionController extends Controller
{

    public function index()
    {
        $questions = Question::
                // where('is_approved',1)
                where('is_rejected',0)
                ->withCount('likes','answers')
                ->with('user','tags')
                ->get();
        if(!$questions->isEmpty()){
            return $questions;
        }else{
            return response()->json(['Message' => 'No question created yet.']);
        }
    }

    public function myQuestions(){
        $questions = Question::where('user_id',auth()->user()->id)
                    ->withCount('likes','answers')->get();
        if(!$questions->isEmpty()){
            return $questions;
        }else{
            return response()->json(['Message' => 'You have not created a question yet']);
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
    
        $category = Category::where('id',$request->category_id)->first();
        if($category != null){
            $question = Question::create([
                'body' => $request->body,
                'category_id' => $request->category_id,
                'user_id' => auth()->user()->id,
            ]);
            if ($question->exists) {
                if($request->tag_ids){
                    $question->tags()->sync($request->tag_ids);
                }
                return response()->json(['success' => 'Question created successfuly'], 200);
             } else {
                return response()->json(['error' => 'Error'], 422);
             }
        }else{
            return response()->json(['Error'=>"Category not found"]);
        }
    }

    public function show(Question $question, $id)
    {
        $question = Question::where('id',$id)
                            ->with('user','tags')
                            ->withCount('likes','answers')
                            // ->with('answers',function($query){
                            //     return $query->limit(1);
                            // })
                            ->first();

        if($question != null){
            $question->setRelation('answers', $question->answers()->select('id','body','user_id')->paginate(1));
            return $question;
        }else{
            return response()->json(['Message' => 'Question with the given id was not found' ]);
        }
    }


    public function edit(Question $question)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required',
            'category_id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }
    
        $category = Category::where('id',$request->category_id)->first();
        if($category != null){
            $question = Question::where('id',$id)->first();
            if($question != null){
                $question->body = $request->body;
                $question->category_id = $request->category_id;
                if($request->tag_ids){
                    $question->tags()->sync($request->tag_ids);
                }
                $question->save();
                if ($question->exists) {
                    if($request->tag_ids){
                        $question->tags()->sync($request->tag_ids);
                    }
                    return response()->json(['success' => 'Question updated successfuly'], 200);
                 } else {
                    return response()->json(['error' => 'Error'], 422);
                 }
            }else{
                return response()->json(['Error' => 'Question not found']);
            }
        }else{
            return response()->json(['Error'=>"Category not found"]);
        }
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

    public function searchQuestion(Request $request){
        $validator = Validator::make($request->all(), [
            'words' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }

        $questions = Question::where('body','LIKE', '%'. $request->words .'%')
                            ->withCount('likes','answers')
                            ->with('user','tags')
                            ->get();

        if(!$questions->isEmpty()){
            return $questions;
        }else{
            return response()->json(['Message' => 'No question matched your query']);
        }
    }

}
