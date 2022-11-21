<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'Odda',
               'email'=>'odda@lmis.gov.et',
               'phone'=>'+251900048949',
               'role'=>'admin',
               'password'=> bcrypt('adminadmin'),
            ]
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
