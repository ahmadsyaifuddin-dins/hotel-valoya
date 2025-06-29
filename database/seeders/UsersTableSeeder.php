<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'nama' => 'Admin Hotel',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'alamat' => 'Jl. Admin No.1',
                'role' => 'ADMIN'
            ],
            [
                'nama' => 'Resepsionis Hotel',
                'username' => 'resepsionis',
                'email' => 'resepsionis@gmail.com',
                'password' => Hash::make('password'),
                'alamat' => 'Jl. Resepsionis No.1',
                'role' => 'RESEPSIONIS'
            ],
            [
                'nama' => 'Sir Steven',
                'username' => 'steven',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'alamat' => 'Jl. User No.1',
                'role' => 'USER'
            ]
        ];

        foreach ($users as $user) {
            DB::table('users')->insert(array_merge($user, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }
    }
}