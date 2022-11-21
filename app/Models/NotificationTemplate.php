<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\EmailAccount;

class NotificationTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'templateId',
        'data',
        'description',
        'is_active',
        'email_account_id'
    ];

    public function emailAccount()
    {
        return $this->belongsTo('App\Models\EmailAccount');
    }

}
