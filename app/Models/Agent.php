<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    public $fillable = [
        'name',
        'phone'
    ];

    public function leads(){
        return $this->hasMany('App\Models\Lead');
    }
}
