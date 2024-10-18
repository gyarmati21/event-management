<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Creating Robot user
        User::create([
            'name' => 'Robot',
            'email' => 'robot@example.com',
            'password' => Hash::make('password'),
        ]);

        // Creating Mike user
        User::create([
            'name' => 'Mike',
            'email' => 'mike@example.com',
            'password' => Hash::make('password'),
        ]);

        // Creating Patrik user
        User::create([
            'name' => 'Patrik',
            'email' => 'patrik@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
