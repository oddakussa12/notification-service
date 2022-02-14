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
        'category_id',
        'is_approved',
        'is_rejected'
    ];

    public function answers(){
        return $this->hasMany('App\Models\Answer');
    }
    public function likes(){
        return $this->hasMany('App\Models\Like');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function isAuthUserLikedQuestion(){
        return $this->likes()->where('user_id',  auth()->id())->exists();
    }
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
    
    public function tags(){
        return $this->belongsToMany('App\Models\Tag');
    }
}
