<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Question;
use Illuminate\Http\Request;
use Validator;

class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::select('id','name','name_am')->get();
        if(!$tags->isEmpty()){
            return $tags;
        }else{
            return response()->json(['Message' => 'No tags are found in the database']);
        }
    }

    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'name_am' => 'required',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $tag = Tag::create($request->all());
        if ($tag->exists) {
            return response()->json(['success' => 'Tag created successfuly'], 200);
        } else {
            return response()->json(['error' => 'Error'], 422);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'name_am' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }

        $tag = Tag::where('id',$id)->first();
        if($tag){
            $tag->update($request->all()); 
            return response()->json(['success' => 'Tag updated successfuly'], 200);
        }else{
            return response()->json(['error' => 'Update unsuccessful, Tag not found'], 404);
        }
    }


    public function destroy(Tag $tag,$id)
    {
        $tag = Tag::where('id',$id)->first();
        if($tag){
            $tag->delete();
            return response()->json(['success' => 'Tag deleted successfuly'], 200);
        }else{
            return response()->json(['error' => 'Delete unsuccessful, Tag not found'], 404);
        }
    }

    public function tagQuestions($tagId){
        $tags = Tag::where('id',$tagId)->with('questions')->first();
        return $tags;
        $tag = Tag::where('id',$tagId)->first();
        $questions = $tag->questions;
        return $questions;
    }
}
