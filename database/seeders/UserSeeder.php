<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultPassword = Hash::make('password123');

        // 1. Two Admin Users
        $admins = [
            [
                'name' => 'Admin One',
                'username' => 'admin1',
                'email' => 'admin1@example.com',
                'role' => 'admin',
                'rating' => '1500',
                'phone' => 251911111111,
                'country' => 'Ethiopia',
                'city' => 'Addis Ababa',
                'organization' => 'Addis Ababa University',
                'college' => 'CNCS',
                'department' => 'Computer Science',
                'occupation' => 'Lecturer',
                'password' => $defaultPassword,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Admin Two',
                'username' => 'admin2',
                'email' => 'admin2@example.com',
                'role' => 'admin',
                'rating' => '1500',
                'phone' => 251922222222,
                'country' => 'Ethiopia',
                'city' => 'Addis Ababa',
                'organization' => 'Addis Ababa University',
                'college' => 'CNCS',
                'department' => 'Software Engineering',
                'occupation' => 'Lecturer',
                'password' => $defaultPassword,
                'email_verified_at' => now(),
            ],
        ];

        foreach ($admins as $adminData) {
            User::updateOrCreate(
                ['username' => $adminData['username']],
                $adminData
            );

            // Ensure permissions entry exists for admin
            DB::table('permissions')->updateOrInsert(
                ['admin' => $adminData['username']],
                [
                    'contest' => 'Yes',
                    'problem' => 'Yes',
                    'user' => 'Yes',
                    'team' => 'Yes',
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }

        // 2. Regular Contestant Users
        $regularUsers = [
            [
                'name' => 'Alex Johnson',
                'username' => 'coder_alex',
                'email' => 'alex@example.com',
                'rating' => '1650',
                'phone' => 251933333331,
                'country' => 'Ethiopia',
                'city' => 'Addis Ababa',
                'organization' => 'Addis Ababa University',
                'college' => 'CNCS',
                'department' => 'Computer Science',
                'occupation' => 'Student',
            ],
            [
                'name' => 'Beth Williams',
                'username' => 'coder_beth',
                'email' => 'beth@example.com',
                'rating' => '1580',
                'phone' => 251933333332,
                'country' => 'Ethiopia',
                'city' => 'Addis Ababa',
                'organization' => 'Addis Ababa University',
                'college' => 'CNCS',
                'department' => 'Computer Science',
                'occupation' => 'Student',
            ],
            [
                'name' => 'Charlie Brown',
                'username' => 'coder_charlie',
                'email' => 'charlie@example.com',
                'rating' => '1520',
                'phone' => 251933333333,
                'country' => 'Ethiopia',
                'city' => 'Addis Ababa',
                'organization' => 'Addis Ababa University',
                'college' => 'AAiT',
                'department' => 'Software Engineering',
                'occupation' => 'Student',
            ],
            [
                'name' => 'Diana Prince',
                'username' => 'coder_diana',
                'email' => 'diana@example.com',
                'rating' => '1480',
                'phone' => 251933333334,
                'country' => 'Ethiopia',
                'city' => 'Addis Ababa',
                'organization' => 'Addis Ababa University',
                'college' => 'AAiT',
                'department' => 'Electrical Engineering',
                'occupation' => 'Student',
            ],
            [
                'name' => 'Ethan Hunt',
                'username' => 'coder_ethan',
                'email' => 'ethan@example.com',
                'rating' => '1420',
                'phone' => 251933333335,
                'country' => 'Ethiopia',
                'city' => 'Addis Ababa',
                'organization' => 'Addis Ababa University',
                'college' => 'CNCS',
                'department' => 'Information Systems',
                'occupation' => 'Student',
            ],
            [
                'name' => 'Fiona Gallagher',
                'username' => 'coder_fiona',
                'email' => 'fiona@example.com',
                'rating' => '1380',
                'phone' => 251933333336,
                'country' => 'Ethiopia',
                'city' => 'Addis Ababa',
                'organization' => 'Addis Ababa University',
                'college' => 'CNCS',
                'department' => 'Computer Science',
                'occupation' => 'Student',
            ],
            [
                'name' => 'George Clark',
                'username' => 'coder_george',
                'email' => 'george@example.com',
                'rating' => '1310',
                'phone' => 251933333337,
                'country' => 'Ethiopia',
                'city' => 'Addis Ababa',
                'organization' => 'Addis Ababa University',
                'college' => 'AAiT',
                'department' => 'Software Engineering',
                'occupation' => 'Student',
            ],
            [
                'name' => 'Hannah Abbott',
                'username' => 'coder_hannah',
                'email' => 'hannah@example.com',
                'rating' => '1250',
                'phone' => 251933333338,
                'country' => 'Ethiopia',
                'city' => 'Addis Ababa',
                'organization' => 'Addis Ababa University',
                'college' => 'CNCS',
                'department' => 'Computer Science',
                'occupation' => 'Student',
            ],
        ];

        foreach ($regularUsers as $userData) {
            $userData['role'] = 'user';
            $userData['password'] = $defaultPassword;
            $userData['email_verified_at'] = now();

            User::updateOrCreate(
                ['username' => $userData['username']],
                $userData
            );
        }

        // Also ensure super-admin has a display name if empty
        User::where('username', 'super-admin')->where(function($q) {
            $q->whereNull('name')->orWhere('name', '');
        })->update([
            'name' => 'Super Admin',
            'country' => 'Ethiopia',
            'city' => 'Addis Ababa',
            'organization' => 'Addis Ababa University',
            'college' => 'CNCS',
            'department' => 'Computer Science',
            'occupation' => 'System Administrator',
            'email_verified_at' => now(),
        ]);
    }
}
