<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\NotificationTemplate;

class EmailAccount extends Model
{
    use HasFactory;

    public $fillable = [
        'ACCOUNT_NAME',
        'MAIL_MAILER',
        'MAIL_HOST',
        'MAIL_PORT',
        'MAIL_USERNAME',
        'MAIL_PASSWORD',
        'MAIL_ENCRYPTION',
        'MAIL_FROM_ADDRESS',
        'MAIL_FROM_NAME'
    ];

    public function notificationTemplates()
    {
        return $this->hasMany('App\Models\NotificationTemplate');
    }
}
