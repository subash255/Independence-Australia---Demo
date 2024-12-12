<?php

namespace Database\Seeders;

use Database\Seeders\AdminUserSeeder;  // Correct namespace for AdminUserSeeder
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(AdminUserSeeder::class);  // Call the AdminUserSeeder class
    }
}
