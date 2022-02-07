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
}
