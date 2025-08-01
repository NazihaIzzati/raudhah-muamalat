<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user if it doesn't exist
        if (!User::where('email', 'admin@jariahfund.com')->exists()) {
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@jariahfund.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]);
        }

        // Create regular user for testing if it doesn't exist
        if (!User::where('email', 'user@jariahfund.com')->exists()) {
            User::create([
                'name' => 'John Doe',
                'email' => 'user@jariahfund.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]);
        }
    }
}