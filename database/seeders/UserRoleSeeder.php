<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create an owner user
        User::create([
            'name' => 'Car Owner',
            'email' => 'owner@example.com',
            'password' => Hash::make('password'),
            'role' => 'owner',
            'number' => '1234567890'
        ]);

        // Create a fleet provider user
        User::create([
            'name' => 'Fleet Provider',
            'email' => 'fleet@example.com',
            'password' => Hash::make('password'),
            'role' => 'fleet_provider',
            'number' => '9876543210'
        ]);

        // Create some additional fleet providers
        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'name' => "Fleet Provider {$i}",
                'email' => "fleet{$i}@example.com",
                'password' => Hash::make('password'),
                'role' => 'fleet_provider',
                'number' => "555000{$i}"
            ]);
        }

        // Create some additional owners
        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'name' => "Car Owner {$i}",
                'email' => "owner{$i}@example.com",
                'password' => Hash::make('password'),
                'role' => 'owner',
                'number' => "444000{$i}"
            ]);
        }
    }
}
