<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;
    public $fillable = [
        'site_code',
        'name'
    ];

    public function blocks(){
        return $this->hasMany('App\Models\Block');
    }
}
