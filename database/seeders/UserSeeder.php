<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Staff;
use App\Models\Donor;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create staff users
        $staffUsers = [
            [
                'user' => [
                    'name' => 'Admin User',
                    'email' => 'admin@jariahfund.com',
                    'password' => Hash::make('password123'),
                    'user_type' => 'staff',
                    'is_active' => true,
                    'email_verified_at' => now(),
                ],
                'staff' => [
                    'employee_id' => 'EMP001',
                    'position' => 'System Administrator',
                    'department' => 'IT',
                    'role' => 'admin',
                    'status' => 'active',
                    'hire_date' => now()->subYears(2),
                    'address' => 'Kuala Lumpur, Malaysia',
                ]
            ],
            [
                'user' => [
                    'name' => 'Sarah Ahmad',
                    'email' => 'sarah.admin@jariahfund.com',
                    'password' => Hash::make('password123'),
                    'user_type' => 'staff',
                    'is_active' => true,
                    'email_verified_at' => now(),
                ],
                'staff' => [
                    'employee_id' => 'EMP002',
                    'position' => 'Operations Manager',
                    'department' => 'Operations',
                    'role' => 'manager',
                    'status' => 'active',
                    'hire_date' => now()->subYear(),
                    'address' => 'Petaling Jaya, Selangor',
                ]
            ],
            [
                'user' => [
                    'name' => 'Ahmad Hassan',
                    'email' => 'ahmad.hassan@jariahfund.com',
                    'password' => Hash::make('password123'),
                    'user_type' => 'staff',
                    'is_active' => true,
                    'email_verified_at' => now(),
                ],
                'staff' => [
                    'employee_id' => 'EMP003',
                    'position' => 'Campaign Coordinator',
                    'department' => 'Marketing',
                    'role' => 'staff',
                    'status' => 'active',
                    'hire_date' => now()->subMonths(6),
                    'address' => 'Shah Alam, Selangor',
                ]
            ],
            [
                'user' => [
                    'name' => 'Fatimah Omar',
                    'email' => 'fatimah.omar@jariahfund.com',
                    'password' => Hash::make('password123'),
                    'user_type' => 'staff',
                    'is_active' => true,
                    'email_verified_at' => now(),
                ],
                'staff' => [
                    'employee_id' => 'EMP004',
                    'position' => 'HQ Representative',
                    'department' => 'Management',
                    'role' => 'hq',
                    'status' => 'active',
                    'hire_date' => now()->subYears(3),
                    'address' => 'Putrajaya, Malaysia',
                ]
            ],
        ];

        foreach ($staffUsers as $staffData) {
            if (!User::where('email', $staffData['user']['email'])->exists()) {
                $user = User::create($staffData['user']);
                Staff::create(array_merge($staffData['staff'], ['user_id' => $user->id]));
            }
        }

        // Create donor users
        $donorUsers = [
            [
                'user' => [
                    'name' => 'Ahmad Ibrahim',
                    'email' => 'ahmad.ibrahim@example.com',
                    'password' => Hash::make('password123'),
                    'user_type' => 'donor',
                    'is_active' => true,
                    'email_verified_at' => now(),
                ],
                'donor' => [
                    'donor_id' => 'DON001',
                    'identification_number' => '800101-01-1234',
                    'donor_type' => 'individual',
                    'status' => 'active',
                    'registration_date' => now()->subMonths(3),
                    'newsletter_subscribed' => true,
                    'address' => 'Shah Alam, Selangor',
                ]
            ],
            [
                'user' => [
                    'name' => 'Fatimah Zahra',
                    'email' => 'fatimah.zahra@example.com',
                    'password' => Hash::make('password123'),
                    'user_type' => 'donor',
                    'is_active' => true,
                    'email_verified_at' => now(),
                ],
                'donor' => [
                    'donor_id' => 'DON002',
                    'identification_number' => '850515-02-5678',
                    'donor_type' => 'individual',
                    'status' => 'active',
                    'registration_date' => now()->subMonths(2),
                    'newsletter_subscribed' => true,
                    'address' => 'Johor Bahru, Johor',
                ]
            ],
            [
                'user' => [
                    'name' => 'Muhammad Ali',
                    'email' => 'muhammad.ali@example.com',
                    'password' => Hash::make('password123'),
                    'user_type' => 'donor',
                    'is_active' => true,
                    'email_verified_at' => now(),
                ],
                'donor' => [
                    'donor_id' => 'DON003',
                    'identification_number' => '900320-03-9012',
                    'donor_type' => 'individual',
                    'status' => 'active',
                    'registration_date' => now()->subMonths(1),
                    'newsletter_subscribed' => false,
                    'address' => 'Penang, Malaysia',
                ]
            ],
            [
                'user' => [
                    'name' => 'Aisha Rahman',
                    'email' => 'aisha.rahman@example.com',
                    'password' => Hash::make('password123'),
                    'user_type' => 'donor',
                    'is_active' => true,
                    'email_verified_at' => now(),
                ],
                'donor' => [
                    'donor_id' => 'DON004',
                    'identification_number' => '920625-04-3456',
                    'donor_type' => 'individual',
                    'status' => 'active',
                    'registration_date' => now()->subWeeks(2),
                    'newsletter_subscribed' => true,
                    'address' => 'Kota Kinabalu, Sabah',
                ]
            ],
            [
                'user' => [
                    'name' => 'Omar Hassan',
                    'email' => 'omar.hassan@example.com',
                    'password' => Hash::make('password123'),
                    'user_type' => 'donor',
                    'is_active' => true,
                    'email_verified_at' => now(),
                ],
                'donor' => [
                    'donor_id' => 'DON005',
                    'identification_number' => '880812-05-7890',
                    'donor_type' => 'individual',
                    'status' => 'active',
                    'registration_date' => now()->subWeeks(1),
                    'newsletter_subscribed' => false,
                    'address' => 'Kuching, Sarawak',
                ]
            ],
            [
                'user' => [
                    'name' => 'Corporate Donor Ltd',
                    'email' => 'donations@corporatedonor.com',
                    'password' => Hash::make('password123'),
                    'user_type' => 'donor',
                    'is_active' => true,
                    'email_verified_at' => now(),
                ],
                'donor' => [
                    'donor_id' => 'DON006',
                    'identification_number' => '202012345678',
                    'donor_type' => 'corporate',
                    'status' => 'active',
                    'registration_date' => now()->subMonths(4),
                    'newsletter_subscribed' => true,
                    'address' => 'Kuala Lumpur, Malaysia',
                ]
            ],
            // Additional donor user from AdminUserSeeder
            [
                'user' => [
                    'name' => 'John Doe',
                    'email' => 'user@jariahfund.com',
                    'password' => Hash::make('password123'),
                    'user_type' => 'donor',
                    'is_active' => true,
                    'email_verified_at' => now(),
                ],
                'donor' => [
                    'donor_id' => 'DON007',
                    'identification_number' => '900101-01-1234',
                    'donor_type' => 'individual',
                    'status' => 'active',
                    'registration_date' => now()->subMonths(2),
                    'newsletter_subscribed' => true,
                    'address' => 'Kuala Lumpur, Malaysia',
                ]
            ],
        ];

        foreach ($donorUsers as $donorData) {
            if (!User::where('email', $donorData['user']['email'])->exists()) {
                $user = User::create($donorData['user']);
                Donor::create(array_merge($donorData['donor'], ['user_id' => $user->id]));
            }
        }

        $this->command->info('✅ User seeding completed!');
        $this->command->info('👥 Staff users created: ' . Staff::count());
        $this->command->info('💝 Donor users created: ' . Donor::count());
        $this->command->info('');
        $this->command->info('🔑 Admin Login Credentials:');
        $this->command->info('Email: admin@jariahfund.com');
        $this->command->info('Password: password123');
        $this->command->info('');
        $this->command->info('🔑 Test Donor Login:');
        $this->command->info('Email: user@jariahfund.com');
        $this->command->info('Password: password123');
    }
} 