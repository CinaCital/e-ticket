<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // register seeder  
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'role' => 'admin',
                'password' => bcrypt('admin123'),
            ],
            [
                'name' => 'User',
                'email' => 'user@user.com',
                'role' => 'user',
                'password' => bcrypt('user123'),
            ],
            [
                'name' => 'maskapai',
                'email' => 'maskapai@mail.com',
                'role' => 'maskapai',
                'password' => bcrypt('password123'),
            ],
            
        ];
        foreach ($users as $user) {
            \App\Models\User::create($user);
        }

    }
}
