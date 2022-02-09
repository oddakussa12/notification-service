<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    public $fillable = [
        'body',
        'user_id',
        'answer_id',
    ];

    public function answer(){
        return $this->belongsTo('App\Models\Answer');
    }

    public function replylikes(){
        return $this->hasMany('App\Models\likereply');
    }

    public function replydislikes(){
        return $this->hasMany('App\Models\Dislikereply');
    }

    public function isAuthUserLikedReply(){
        return $this->replylikes()->where('user_id',  auth()->id())->exists();
    }

    public function isAuthUserDislikedReply(){
        return $this->replydislikes()->where('user_id',  auth()->id())->exists();
    }
}
