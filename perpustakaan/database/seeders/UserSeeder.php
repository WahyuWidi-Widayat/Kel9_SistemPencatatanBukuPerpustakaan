<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Root User',
            'email' => 'root@perpus.com',
            'password' => Hash::make('password'),
            'role' => 'root',
        ]);

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@perpus.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
}
