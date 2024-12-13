<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Super',
            'last_name' => 'Admin',
            'role' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('admin123'),
        ]);
    }
}
