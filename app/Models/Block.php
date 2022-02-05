<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;
    public $fillable = [
        'site_id',
        'location',
        'block_code',
        'description'
    ];

    public function site(){
        return $this->belongsTo('App\Models\Site');
    }

    public function floors(){
        return $this->hasMany('App\Models\Floor');
    }
}
