<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => Str::uuid(),
                'name' => 'Odda Kussa',
                'email' => 'odda@lmis.gov.et',
                'password' => Hash::make('adminadmin'),
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
    }
}
