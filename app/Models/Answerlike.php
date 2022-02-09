<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answerlike extends Model
{
    use HasFactory;

    public $fillable = [
        'answer_id',
        'user_id'
    ];

    public function answer(){
        return $this->belongsTo('App\Models\Answer');
    }
}
