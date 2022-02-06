<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    public $fillable = [
        'progress',
        'status',
        'agent_id',
        'prospect_name',
        'prospect_phone',
        'office_invitation',
        'site_visit',
        'reservation',
        'unit_id'
    ];

    public function agent(){
        return $this->belongsTo('App\Models\Agent');
    }
    public function unit(){
        return $this->belongsTo('App\Models\Unit');
    }
}
