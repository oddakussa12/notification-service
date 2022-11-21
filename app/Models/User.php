<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Traits\uuidTrait;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, uuidTrait;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
   
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'device_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

   
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function routeNotificationForFcm()
    {
        return $this->device_token;
    }
}
