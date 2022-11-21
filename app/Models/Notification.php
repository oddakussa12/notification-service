<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{
    use HasFactory;
    
    protected $fillable = [
        'type',
        'notifiable',
        'data',
    ];


    public function users()
    {
        return $this->belongsTo(User::class, 'notifiable_id');
    }
}
