<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'phone',
        'is_active',
        'group_id',
        'payingDate'
    ];

    public function group(){
        return $this->belongsTo('App\Models\Group');
    }
}
