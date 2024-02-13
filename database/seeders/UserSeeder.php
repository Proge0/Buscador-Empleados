<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('Admin123.'),
        ]);

               DB::table('users')->insert([
            'username' => 'user',
            'email' => 'user@admin.com',
              'rol' => 'ADM',
            'password' => Hash::make('User123.'),
        ]);
    }
}
