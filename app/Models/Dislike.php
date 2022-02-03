<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dislike extends Model
{
    use HasFactory;
    
    public $fillable = [
        'user_id',
        'question_id'
    ];
    public function question(){
        return $this->belongsTo('App\Models\Question');
    }
}
