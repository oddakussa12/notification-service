<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\InappLanguage;

class InappNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description'
    ];

    public function inappLanguages(){
        return $this->hasMany(InappLanguage::class);
    }
}
