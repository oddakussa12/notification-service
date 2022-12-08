<?php

namespace App\Helpers;

use App\Models\EmailAccount;
use Illuminate\Support\Facades\Log;

class ConfigureEmailAccount
{

    public static function setMailConfig($account_name){
        $emailAccount = EmailAccount::where('ACCOUNT_NAME',$account_name)->first();
        $mailConfig = [
            'transport' => 'smtp',
            'host' => $emailAccount->MAIL_HOST,
            'port' => $emailAccount->MAIL_PORT,
            'encryption' => $emailAccount->MAIL_ENCRYPTION,
            'username' => $emailAccount->MAIL_USERNAME,
            'password' => $emailAccount->MAIL_PASSWORD,
            'local_domain' => env('MAIL_EHLO_DOMAIN'),
            'timeout' => null,
            'auth_mode'  => null,
            'verify_peer'       => false,   // <------ IT HAS TO BE HERE
        ];
        config(['mail.mailers.smtp' => $mailConfig]);

        Log::info("Email account configured");
    }
}