<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'ADMIN',
                'role_id' => 1,
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'St. Elizabeth Hospital',
                'role_id' => 2,
                'email' => 'elizabeth@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'General Santos Doctor Hospital Inc.',
                'role_id' => 2,
                'email' => 'general@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Sarmed',
                'role_id' => 2,
                'email' => 'sarmed@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'ACE Medical Center',
                'role_id' => 2,
                'email' => '@ace@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'St. Louis Hospital',
                'role_id' => 2,
                'email' => 'stlouis@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Northern Mindanao Medical Center',
                'role_id' => 2,
                'email' => 'northern@gmail.com',
                'password' => Hash::make('password'),
            ],
        ]);
    }
}
