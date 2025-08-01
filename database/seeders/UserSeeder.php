<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin users
        $adminUsers = [
            [
                'name' => 'Admin User',
                'email' => 'admin@raudhahmuamalat.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'phone' => '+60 3-1234 5678',
                'address' => 'Kuala Lumpur, Malaysia',
                'bio' => 'System Administrator for Raudhah Muamalat platform',
                'status' => 'active',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Sarah Ahmad',
                'email' => 'sarah.admin@raudhahmuamalat.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'phone' => '+60 3-2345 6789',
                'address' => 'Petaling Jaya, Selangor',
                'bio' => 'Operations Manager overseeing daily platform operations',
                'status' => 'active',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($adminUsers as $userData) {
            if (!User::where('email', $userData['email'])->exists()) {
                User::create($userData);
            }
        }

        // Create regular users/donors
        $regularUsers = [
            [
                'name' => 'Ahmad Ibrahim',
                'email' => 'ahmad.ibrahim@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '+60 12-345 6789',
                'address' => 'Shah Alam, Selangor',
                'bio' => 'Software Engineer passionate about helping the community',
                'status' => 'active',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Fatimah Zahra',
                'email' => 'fatimah.zahra@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '+60 13-456 7890',
                'address' => 'Johor Bahru, Johor',
                'bio' => 'Teacher dedicated to education and community service',
                'status' => 'active',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Muhammad Ali',
                'email' => 'muhammad.ali@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '+60 14-567 8901',
                'address' => 'Penang, Malaysia',
                'bio' => 'Business Owner supporting charitable causes',
                'status' => 'active',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Aisha Rahman',
                'email' => 'aisha.rahman@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '+60 15-678 9012',
                'address' => 'Kota Kinabalu, Sabah',
                'bio' => 'Doctor committed to healthcare and humanitarian work',
                'status' => 'active',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Omar Hassan',
                'email' => 'omar.hassan@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '+60 16-789 0123',
                'address' => 'Kuching, Sarawak',
                'bio' => 'Engineer with a passion for community development',
                'status' => 'active',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Khadijah Yusof',
                'email' => 'khadijah.yusof@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '+60 17-890 1234',
                'address' => 'Ipoh, Perak',
                'bio' => 'Accountant supporting financial transparency in charity',
                'status' => 'active',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Yusuf Abdullah',
                'email' => 'yusuf.abdullah@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '+60 18-901 2345',
                'address' => 'Melaka, Malaysia',
                'bio' => 'Marketing Manager promoting social causes',
                'status' => 'active',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Maryam Salleh',
                'email' => 'maryam.salleh@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '+60 19-012 3456',
                'address' => 'Alor Setar, Kedah',
                'bio' => 'Nurse dedicated to healthcare and community welfare',
                'status' => 'active',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Zaid Malik',
                'email' => 'zaid.malik@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '+60 11-234 5678',
                'address' => 'Putrajaya, Malaysia',
                'bio' => 'Government officer supporting public welfare initiatives',
                'status' => 'active',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Halimah Sadiq',
                'email' => 'halimah.sadiq@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '+60 12-987 6543',
                'address' => 'Cyberjaya, Selangor',
                'bio' => 'IT Professional contributing to digital charity solutions',
                'status' => 'active',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($regularUsers as $userData) {
            if (!User::where('email', $userData['email'])->exists()) {
                User::create($userData);
            }
        }

        // Create some unverified users for testing
        $unverifiedUsers = [
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '+60 11-111 1111',
                'address' => 'Test Address, Malaysia',
                'bio' => 'Test user account for development purposes',
                'status' => 'active',
                'email_verified_at' => null,
            ],
            [
                'name' => 'Inactive User',
                'email' => 'inactive@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '+60 11-222 2222',
                'address' => 'Inactive Address, Malaysia',
                'bio' => 'Inactive user account for testing',
                'status' => 'inactive',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($unverifiedUsers as $userData) {
            if (!User::where('email', $userData['email'])->exists()) {
                User::create($userData);
            }
        }

        $this->command->info('Created ' . User::count() . ' users (' . User::where('role', 'admin')->count() . ' admins, ' . User::where('role', 'user')->count() . ' regular users)');
    }
} 