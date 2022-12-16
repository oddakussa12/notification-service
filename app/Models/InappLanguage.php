<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InappLanguage extends Model
{
    use HasFactory;

    public $fillable = [
        'inapp_notification_id',
        'code',
        'subject',
        'body'
    ];

    public function  inapp_notification(){
        return $this->belongsTo(InappNotification::class);
    }
}
