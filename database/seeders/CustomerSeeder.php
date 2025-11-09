<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $customers = [
            [
                'name' => 'John Doe',
                'email' => 'test@example.com',
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'phone' => '+60123456788',
                'address' => '456 Customer Avenue, Shopping District',
                'city' => 'Petaling Jaya',
                'state' => 'Selangor',
                'zip_code' => '46100',
                'country' => 'Malaysia',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'phone' => '+60123456787',
                'address' => '789 Fashion Street, Mall Area',
                'city' => 'Subang Jaya',
                'state' => 'Selangor',
                'zip_code' => '47500',
                'country' => 'Malaysia',
            ],
            [
                'name' => 'David Brown',
                'email' => 'david@example.com',
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'phone' => '+60123456784',
                'address' => '987 Family Street, Residential Area',
                'city' => 'Shah Alam',
                'state' => 'Selangor',
                'zip_code' => '40000',
                'country' => 'Malaysia',
            ],
        ];

        foreach ($customers as $customer) {
            User::create($customer);
        }
    }
} 