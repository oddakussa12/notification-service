<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    public $fillable = [
        'smsmessage_id',
        'message',
        'code'
    ];

    public function  smsmessage(){
        return $this->belongsTo(Smsmessage::class);
    }
}
