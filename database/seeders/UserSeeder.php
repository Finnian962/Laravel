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
            'name' => 'Hier jouw naam',
            'email' => 'jouw@email.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
        ]);
    }
}
