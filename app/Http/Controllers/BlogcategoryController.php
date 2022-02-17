<?php

namespace App\Http\Controllers;

use App\Models\Blogcategory;
use App\Models\Blog;
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

    public function categoryBlogs($categoryId){
        $blogs = Blog::where('blogcategory_id',$categoryId)
                    ->withCount('bloglikes')->get();
        if(!$blogs->isEmpty()){
            foreach($blogs as $blog){
                $blog->file_path = 'https://dating.yenesera.com/blogImages/'.$blog->file;
                $blog->has_liked = $blog->isAuthUserLikedBlog();
                $blog->posted_on = Carbon::parse($blog->created_at)->format('D,d M,Y');
            }
            return $blogs;
        }else{
            return response()->json(['error' => 'No blogs are found in this category']);
        }
    }

}
