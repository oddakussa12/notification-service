<?php

namespace App\Http\Controllers;

use App\Models\Save;
use App\Models\Blog;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;

class SaveController extends Controller
{
   
    public function saveBlog(Request $request){
        $validator = Validator::make($request->all(), [
            'blog_id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }
        $blog = Blog::where('id',$request->blog_id)->first();
        if(auth()->user()->hasSavedBlog($blog)){
            auth()->user()->blogsaves()->detach($request->blog_id);
            return response()->json(['Message' => "Blog removed from saved list."], 200);
        }else{
            auth()->user()->blogsaves()->attach($request->blog_id);
            return response()->json(['Message' => "Blog saved"], 200);
        }
        
    }

    public function unsaveBlog(Request $request){
        $validator = Validator::make($request->all(), [
            'blog_id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }
        auth()->user()->blogsaves()->detach($request->blog_id);

        return response()->json(['Message' => "Blog removed from saved list"], 200);
    }

    public function mySavedBlogs(){
        $blogs = auth()->user()->blogsaves()->latest()->get();
        if(!$blogs->isEmpty()){
            foreach($blogs as $blog){
                $blog->file_path = 'https://dating.yenesera.com/blogImages/'.$blog->file;
                $blog->has_liked = $blog->isAuthUserLikedBlog();
                $blog->posted_on = Carbon::parse($blog->created_at)->format('D,d M,Y');
            }
            return $blogs;
            
        }else{
            return response()->json(['Message'=> 'No saved blogs.',
                                        'data' => []]);
        }
    }
}
