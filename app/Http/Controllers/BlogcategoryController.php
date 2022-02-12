<?php

namespace App\Http\Controllers;

use App\Models\Blogcategory;
use Illuminate\Http\Request;
use Validator;

class BlogcategoryController extends Controller
{

    public function index()
    {
        $blogCategories = Blogcategory::select('id','name','name_am')->get();
        if(!$blogCategories->isEmpty()){
            return $blogCategories;
        }else{
            return response()->json(['Message' => 'No blog categories found in the database']);
        }
    }

    public function categoryBlogs(){

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'name_am' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }
        $category = Blogcategory::create($request->all());
        if ($category->exists) {
            return response()->json(['success' => 'Blog Category created successfuly'], 200);
        } else {
            return response()->json(['error' => 'Error'], 422);
        }
    }

    public function show(Blogcategory $blogcategory)
    {
        //
    }


    public function edit(Blogcategory $blogcategory)
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

        $category = Blogcategory::where('id',$id)->first();
        if($category){
            $category->update($request->all()); 
            return response()->json(['success' => 'Blog Category updated successfuly'], 200);
        }else{
            return response()->json(['error' => 'Update unsuccessful,Blog Category not found'], 404);
        }
    }

    public function destroy($id)
    {
        $category = Blogcategory::where('id',$id)->first();
        if($category){
            $category->delete();
            $category->blogs()->delete();
            return response()->json(['success' => 'Blog Category deleted successfuly'], 200);
        }else{
            return response()->json(['error' => 'Delete unsuccessful,Blog Category not found'], 404);
        }
    }
}
