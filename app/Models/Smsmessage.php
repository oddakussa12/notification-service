<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smsmessage extends Model
{

    use HasFactory;

    public $filable = [
        'title'
    ];

    public function languages(){
        return $this->hasMany(Language::class);
    }

}
