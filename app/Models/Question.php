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
        'like_count',
        'dislike_count',
        'reply_count',
        'is_approved',
    ];
}
