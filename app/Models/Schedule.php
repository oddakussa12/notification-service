<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'message',
        'date_time',
    ];

    public function groups(){
        return $this->hasMany('App\Models\Group');
    }
}
