<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Validator;

class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::withCount('bloglikes')->latest()->paginate(10);
        foreach($blogs as $blog){
            $blog->file_path = 'http://localhost:8000/blogImages/'.$blog->file;
            $blog->has_liked = $blog->isAuthUserLikedBlog();
        }
        if(!$blogs->isEmpty()){
            return $blogs;
        }else{
            return response()->json(['Message' => 'No blog posted yet']);
        }
        
    }

    public function categoryBlogs($id){
        $blogs = Blog::where('category_id',$id)->withCount('bloglikes')->latest()->paginate(10);
        if(!$blogs->isEmpty()){
            foreach($blogs as $blog){
                $blog->file_path = 'http://localhost:8000/blogImages/'.$blog->file;
                $blog->has_liked = $blog->isAuthUserLikedBlog();
            }
            return $blogs;
        }else{
            return response()->json(['Message' => 'No blogs are found in the category.']);
        }
    }



    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $image = $request->file('file');
        if($request->hasFile('file')){
            $validator = Validator::make($request->all(), [
                'title'         => 'required',
                // 'title_am'         => 'required',
                // 'description_am'         => 'required',
                'description'   => 'required',
                'category_id'   => 'required',
                'file'     => 'mimes:jpeg,jpg,png,gif|required|max:10000', //kb
            ]);
            if($validator->fails()){
                return response()->json(['errors'=>$validator->errors()]);
            }

            $name = rand().'.'.$image->getClientOriginalName();
            $image->move(public_path('/blogImages'),$name);
            // $image->storeAs('public/',$name);
            $blog = new Blog();
            
            $blog->title = $request->title;
            $blog->description = $request->description;
            $blog->file = $name;
            $blog->category_id = $request->category_id;

            if($request->title_am){
                $blog->title_am = $request->title_am;
            }
            if($request->description_am){
                $blog->description_am = $request->description_am;
            }
           
            $blog->save();

            if ($blog->exists) {
                return response()->json(['success' => 'Blog created successfuly'], 200);
            } else {
                return response()->json(['error' => 'Error'], 422);
            }
            
        }else{
            return response()->json('Please choose a file');
        }
    }


    public function show($id)
    {
        $blog = Blog::where('id',$id)->first();
        
        if($blog != null){
            $category_id = $blog->category_id;
            $relatedBlogs = Blog::where('category_id',$category_id)
                            ->withCount('bloglikes')->latest()->paginate(6);
            foreach($relatedBlogs as $related){
                $related->file_path = 'http://localhost:8000/blogImages/'.$related->file;
                $related->has_liked = $related->isAuthUserLikedBlog();
            }
            
            return $relatedBlogs;
        }else{
            return response()->json(['error' => 'Blog not found'], 404);
        }
    }


    public function edit(Blog $blog)
    {
        //
    }


    public function update(Request $request, $id)
    {
        return $request;
        $image = $request->file('file');
        if($request->hasFile('file')){
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'category_id' => 'required',
                'file'     => 'mimes:jpeg,jpg,png,gif|required|max:10000', //kb
            ]);
            if($validator->fails()){
                return response()->json(['errors'=>$validator->errors()]);
            }

            $name = rand().'.'.$image->getClientOriginalName();
            $image->move(public_path('/blogImages'),$name);
            
            $blog = Blog::where('id',$id)->first();
            
            $blog->title = $request->title;
            $blog->file = $name;
            $blog->description = $request->description;
            $blog->category_id = $request->category_id;
            if($request->title_am){
                $blog->title_am = $request->title_am;
            }
            if($request->description_am){
                $blog->description_am = $request->description_am;
            }
            $blog->save();

            if ($blog->exists) {
                return response()->json(['success' => 'Blog updated successfuly'], 200);
            } else {
                return response()->json(['error' => 'Error'], 422);
            }
            
        }else{
            return response()->json('Please choose image file');
        }
    }


    public function destroy(Blog $blog, $id)
    {
        $blog = Blog::where('id',$id)->first();
        if($blog){
            $blog->delete();
            return response()->json(['success' => 'Blog deleted successfuly'], 200);
        }else{
            return response()->json(['error' => 'Delete unsuccessful, Blog not found'], 404);
        }
    }
}
