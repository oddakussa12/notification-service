<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            NotificationTemplatesTableSeeder::class,
            EmailAccountsTableSeeder::class,
            // CreateUsersSeeder::class,
            UserSeeder::class
            // you can call other seeder classes from here
        ]);
    }
}
