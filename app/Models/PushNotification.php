<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\PushLanguage;

class PushNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description'
    ];

    public function pushlanguages(){
        return $this->hasMany(PushLanguage::class);
    }
}
