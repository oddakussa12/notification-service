<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EmailAccount;

class EmailAccountSeeder extends Seeder
{

    public function run()
    {
        EmailAccount::factory()->count(5)->create();
    }
}
