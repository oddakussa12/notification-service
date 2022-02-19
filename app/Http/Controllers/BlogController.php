<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tag;
use App\Models\Bloglike;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;


class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::withCount('bloglikes')
            ->latest()->paginate(10);
        foreach($blogs as $blog){
            $blog->file_path = 'https://dating.yenesera.com/blogImages/'.$blog->file;
            $blog->has_liked = $blog->isAuthUserLikedBlog();
            $blog->posted_on = Carbon::parse($blog->created_at)->format('D,d M,Y');
        }
        if(!$blogs->isEmpty()){
            return $blogs;
        }else{
            return response()->json(['Message' => 'No blog posted yet']);
        }
        
    }

    public function categoryBlogs($id){
        $blogs = Blog::where('blogcategory_id',$id)->withCount('bloglikes')->latest()->paginate(10);
        if(!$blogs->isEmpty()){
            foreach($blogs as $blog){
                $blog->file_path = 'https://dating.yenesera.com/blogImages/'.$blog->file;
                $blog->has_liked = $blog->isAuthUserLikedBlog();
                $blog->posted_on = Carbon::parse($blog->created_at)->format('D,d M,Y');
            }
            return $blogs;
        }else{
            return response()->json(['Message' => 'No blogs are found in the category.']);
        }
    }
    public function tagBlogs($tagid){
        $tag = Tag::where('id',$tagid)->first();
        if($tag != null){
            $blogs = $tag->blogs()->withCount('bloglikes')->paginate(10);
            foreach($blogs as $blog){
                $blog->file_path = 'https://dating.yenesera.com/blogImages/'.$blog->file;
                $blog->has_liked = $blog->isAuthUserLikedBlog();
                $blog->posted_on = Carbon::parse($blog->created_at)->format('D,d M,Y');
            }
            return $blogs;
        }else{
            return response()->json(['Message' => "Tag not found"]);
        }
    }

    public function show($id)
    {
        $blog = Blog::where('id',$id)->first();
        
        if($blog != null){
            $hasSaved = auth()->user()->hasSavedBlog($blog);
            
            $blog->hasSaved = auth()->user()->hasSavedBlog($blog);
            $tags = $blog->tags;
            $category_id = $blog->blogcategory_id;
            $relatedBlogs = Blog::where('blogcategory_id',$category_id)
                            ->where('id','!=',$id)
                            ->withCount('bloglikes')->latest()->paginate(6);
            foreach($relatedBlogs as $related){
                $related->file_path = 'https://dating.yenesera.com/blogImages/'.$related->file;
                $related->has_liked = $related->isAuthUserLikedBlog();
                $related->posted_on = Carbon::parse($related->created_at)->format('D,d M,Y');
            }
            return response()->json(['related' => $relatedBlogs ,
                                     'tags' => $tags,
                                    'hasSaved' => $hasSaved]);
        }else{
            return response()->json(['error' => 'Blog not found'], 404);
        }
    }

    public function likeBlog(Request $request){
        $validator = Validator::make($request->all(), [
            'blog_id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }
        
        $blog = Blog::where('id',$request->blog_id)->first();
        if($blog != null){
            // check if user liked the question already
            if($blog->isAuthUserLikedBlog()){
                $like = Bloglike::where('user_id',auth()->user()->id)
                                ->where('blog_id',$blog->id)->first();
                $like->delete();
                return response()->json(['Error' => "You disliked the blog"]);
            }else{
                $bloglike = Bloglike::create([
                    'blog_id' => $request->blog_id,
                    'user_id' => auth()->user()->id,
                ]);
                if ($bloglike->exists) {
                    return response()->json(['success' => 'You liked the blog'], 200);
                 } else {
                    return response()->json(['error' => 'Error'], 422);
                 }
            }

        }else{
            return response()->json(['Error' => "The blog does't exist"]);
        }
    }

    public function filter(Request $request){
        if($request->filter_by){
            if($request->filter_by == 'popular'){
                $blogs = Blog::
                withCount('bloglikes')
                
                ->orderBy('bloglikes_count','desc')->paginate(10);
                if(!$blogs->isEmpty()){
                    foreach($blogs as $blog){
                        $blog->file_path = 'https://dating.yenesera.com/blogImages/'.$blog->file;
                        $blog->has_liked = $blog->isAuthUserLikedBlog();
                        $blog->posted_on = Carbon::parse($blog->created_at)->format('D,d M,Y');
                    }
                    return $blogs;
                }else{
                    return response()->json(['Message' => 'No blogs']);
                }
            }else{
                $blogs = Blog::
                withCount('bloglikes')
                
                ->orderBy('created_at','desc')->paginate(10);
                if(!$blogs->isEmpty()){
                    foreach($blogs as $blog){
                        $blog->file_path = 'https://dating.yenesera.com/blogImages/'.$blog->file;
                        $blog->has_liked = $blog->isAuthUserLikedBlog();
                        $blog->posted_on = Carbon::parse($blog->created_at)->format('D,d M,Y');
                    }
                    return $blogs;
                }else{
                    return response()->json(['Message' => 'No blog found.']);
                }
            }
        }else{
            return response()->json(['Message' => 'filter_by field is required']);
        }
    }

    public function searchBlog(Request $request){
        $validator = Validator::make($request->all(), [
            'words' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }

        $blogs = Blog::where('title','LIKE', '%'. $request->words .'%')
                            ->withCount('bloglikes')
                            ->orderBy('bloglikes_count','desc')->paginate(10);

        if(!$blogs->isEmpty()){
            foreach($blogs as $blog){
                $blog->file_path = 'https://dating.yenesera.com/blogImages/'.$blog->file;
                $blog->has_liked = $blog->isAuthUserLikedBlog();
                $blog->posted_on = Carbon::parse($blog->created_at)->format('D,d M,Y');
            }
            return $blogs;
        }
        return $blogs;
    }
}
