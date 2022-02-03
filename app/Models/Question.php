<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public $fillable = [
        'body',
        'user_id',
        'like_count',
        'dislike_count',
        'reply_count',
        'is_approved',
        'is_rejected'
    ];
    public function likes(){
        return $this->hasMany('App\Models\Like');
    }

    public function isAuthUserLikedQuestion(){
        return $this->likes()->where('user_id',  auth()->id())->exists();
    }

    public function dislikes(){
        return $this->hasMany('App\Models\Dislike');
    }

    public function isAuthUserDislikedQuestion(){
        return $this->dislikes()->where('user_id',  auth()->id())->exists();
    }
}
