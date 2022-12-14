<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emaillanguage extends Model
{
    use HasFactory;

    public $fillable = [
        'notificationtemplate_id',
        'code',
        'body'
    ];

    public function  notification_template(){
        return $this->belongsTo(NotificationTemplate::class);
    }
}
