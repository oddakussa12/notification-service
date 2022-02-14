<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    public $fillable = [
        'title',
        'title_am',
        'description',
        'description_am',
        'blogcategory_id',
        'file'
    ];

    public function blogcategory(){
        return $this->belongsTo('App\Models\Blogcategory');
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag');
    }

    public function bloglikes(){
        return $this->hasMany('App\Models\Bloglike');
    }
    public function isAuthUserLikedBlog(){
        return $this->bloglikes()->where('user_id',  auth()->id())->exists();
    }
}
