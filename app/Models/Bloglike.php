<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bloglike extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'blog_id'
    ];

    public function blog(){
        return $this->belongsTo('App\Models\Blog');
    }
}
