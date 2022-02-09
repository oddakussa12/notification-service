<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    public $fillable = [
        'body',
        'user_id',
        'question_id',
    ];

    public function question(){
        return $this->belongsTo('App\Models\Question');
    }

    public function replies(){
        return $this->hasMany('App\Models\Reply');
    }

    public function answerlikes(){
        return $this->hasMany('App\Models\Answerlike');
    }

    public function answerdislikes(){
        return $this->hasMany('App\Models\Dislikeanswer');
    }

    public function isAuthUserLikedAnswer(){
        return $this->answerlikes()->where('user_id',  auth()->id())->exists();
    }

    public function isAuthUserDislikedAnswer(){
        return $this->answerdislikes()->where('user_id',  auth()->id())->exists();
    }
}
