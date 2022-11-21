<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmailAccountsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('email_accounts')->delete();
        
        \DB::table('email_accounts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'ACCOUNT_NAME' => 'OTP-Email',
                'MAIL_MAILER' => 'smtp',
                'MAIL_HOST' => 'smtp.gmail.com',
                'MAIL_PORT' => '587',
                'MAIL_USERNAME' => 'no-reply@lmis.gov.et',
                'MAIL_PASSWORD' => '*rDmWF=UJV2gF8eX',
                'MAIL_ENCRYPTION' => 'STARTTLS',
                'MAIL_FROM_ADDRESS' => 'no-reply@lmis.gov.et',
                'MAIL_FROM_NAME' => 'LMIS',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}