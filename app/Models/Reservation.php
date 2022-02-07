<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    public $fillable = [
        'status',
        'agent_id'
    ];

    public function agent(){
        return $this->belongsTo('App\Models\Agent');
    }
}
