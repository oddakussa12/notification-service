<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Blogcategory;
use Illuminate\Http\Request;
use App\Models\Reportword;

class SidemenuController extends Controller
{
    public function unapprovedQuestions(){
        $tags = Tag::select('id','name')->latest()->get();
        $categories = Category::select('id','name')->latest()->get();
        $questions = Question::where('is_approved',0)->latest()->get();
        return view('Admin/unapprovedQuestions',compact('questions','tags','categories'));
    }

    public function approvedQuestions(){
        $tags = Tag::select('id','name')->latest()->get();
        $categories = Category::select('id','name')->latest()->get();
        $questions = Question::where('is_approved',1)->latest()->get();
        return view('Admin/approvedQuestions',compact('questions','tags','categories'));
    }

    public function rejectedQuestions(){
        $questions = Question::where('is_rejected',1)->latest()->get();
        return view('Admin/rejectedQuestions',compact('questions'));
    }

    public function categoryTag(){
        $categories = Category::latest()->get();
        $blogCategories = Blogcategory::latest()->get();
        $tags = Tag::latest()->get();
        $reportwords = Reportword::latest()->get();

        return view('Admin/categorytag', compact('categories','blogCategories','tags','reportwords'));
    }
    public function blogs(){
        $tags = Tag::select('id','name')->latest()->get();
        $blogCategories = Blogcategory::select('id','name')->latest()->get();
        return view('Admin/blogs',compact('blogCategories','tags'));
    }
}
