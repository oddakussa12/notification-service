<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    public $fillable = [
        'unit_code',
        'status',
        'direction',
        'bedrooms',
        'floor_id'
    ];

    public function floor(){
        return $this->belongsTo('App\Models\Floor');
    }
    public function lead(){
        return $this->hasOne('App\Models\Lead');
    }
}
