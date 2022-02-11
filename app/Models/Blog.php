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
        'category_id',
        'file'
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag');
    }

    public function bloglikes(){
        return $this->hasMany('App\Models\Bloglike');
    }
    public function isAuthUserLikedBlog(){
        return $this->answerdislikes()->where('user_id',  auth()->id())->exists();
    }
}
