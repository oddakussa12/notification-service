<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $fillable = [
        'name',
        'name_am'
    ];

    public function questions(){
        return $this->hasMany('App\Models\Question');
    }

    public function blogs(){
        return $this->hasMany('App\Models\Blog');
    }
}
