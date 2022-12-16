<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushLanguage extends Model
{
    use HasFactory;

    public $fillable = [
        'push_notification_id',
        'code',
        'subject',
        'body'
    ];

    public function  push_notification(){
        return $this->belongsTo(PushNotification::class);
    }
}
