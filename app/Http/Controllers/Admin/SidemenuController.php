<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Blogcategory;
use Illuminate\Http\Request;

class SidemenuController extends Controller
{
    public function unapprovedQuestions(){
        $questions = Question::where('is_approved',0)->latest()->get();
        return view('Admin/unapprovedQuestions',compact('questions'));
    }

    public function categoryTag(){
        $categories = Category::latest()->get();
        $blogCategories = Blogcategory::latest()->get();
        $tags = Tag::latest()->get();

        return view('Admin/categorytag', compact('categories','blogCategories','tags'));
    }
}
