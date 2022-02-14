<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dislikeanswer extends Model
{
    use HasFactory;
    public $fillable = [
        'user_id',
        'answer_id'
    ];

    public function answer(){
        return $this->belongsTo('App\Models\Answer');
    }
}
