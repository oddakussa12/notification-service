<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dislikereply extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'reply_id'
    ];

    public function reply(){
        return $this->belongsTo('App\Models\Reply');
    }
}
