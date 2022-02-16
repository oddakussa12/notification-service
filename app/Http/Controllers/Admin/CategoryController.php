<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::select('id','name','name_am')->get();
        if(!$categories->isEmpty()){
            return $categories;
        }else{
            return response()->json(['Message' => 'No category found in the database']);
        }
    }


    public function create()
    {
        //
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
        
        $category = Category::create($request->all());
        if ($category->exists) {
            return response()->json(['success' => 'Category created successfuly'], 200);
        } else {
            return response()->json(['error' => 'Error'], 422);
        }
    }


    public function show(Category $category)
    {
        //
    }


    public function edit(Category $category)
    {
        //
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

        $category = Category::where('id',$id)->first();
        if($category){
            $category->update($request->all()); 
            return response()->json(['success' => 'Category updated successfuly'], 200);
        }else{
            return response()->json(['error' => 'Update unsuccessful, Category not found'], 404);
        }
    }

    public function destroy(Category $category,$id)
    {
        $category = Category::where('id',$id)->first();
        if($category){
            $category->delete();
            $category->questions()->delete();
            return response()->json(['success' => 'Category deleted successfuly'], 200);
        }else{
            return response()->json(['error' => 'Delete unsuccessful, Category not found'], 404);
        }
    }

    public function categoryQuestions($categoryId){
        $questions = Question::where('category_id',$categoryId)
                    ->withCount('likes','answers')
                    ->with(['user' => function ($query) {
                            $query->select('id', 'name');
                        }])
                    ->with('tags')->latest()->get();
        if(!$questions->isEmpty()){
            foreach($questions as $question){
                $question->has_liked = $question->isAuthUserLikedQuestion();
            }
            return $questions;
        }else{
            return $questions;
            // return response()->json(['Message' => 'No question found in this category']);
        }
    }
}
