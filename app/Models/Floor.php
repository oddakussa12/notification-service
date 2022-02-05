<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;
    public $fillable = [
        'level',
        'block_id'
    ];

    public function block(){
        return $this->belongsTo('App\Models\Block');
    }

    public function units(){
        return $this->hasMany('App\Models\Unit');
    }
}
