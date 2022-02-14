<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'phone',
        'email',
        'password',
        'role',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function blogsaves(){
        return $this->belongsToMany('App\Models\Blog');
    }

    public function questions(){
        return $this->hasMany('App\Models\Question');
    }

    public function answers(){
        return $this->hasMany('App\Models\Answer');
    }

    public function replies(){
        return $this->hasMany('App\Models\Reply');
    }

    // used to check if user saved a given blog
    public function hasSavedBlog($blog)
    {
        return $this->blogsaves()->where('blog_id', $blog->id)->exists();
    }
}
