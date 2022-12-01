<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationCount extends Model
{
    use HasFactory;

    public $protected = [
        'sms_count',
        'email_count'
    ];
}
