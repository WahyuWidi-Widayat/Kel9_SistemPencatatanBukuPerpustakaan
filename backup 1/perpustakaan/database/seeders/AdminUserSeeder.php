<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Root User',
            'email' => 'root@app.com',
            'password' => Hash::make('root123'),
            'role' => 'root',
        ]);
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@app.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
    }
}