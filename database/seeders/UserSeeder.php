<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Manager
        User::updateOrCreate(
            ['email' => 'dheka@pos.com'],
            [
                'name' => 'Dheka',
                'password' => Hash::make('password123'),
                'role' => 'manager',
                'is_active' => true,
            ]
        );

        // Cashiers
        User::updateOrCreate(
            ['email' => 'siti@pos.com'],
            [
                'name' => 'Siti Nurhaliza',
                'password' => Hash::make('password123'),
                'role' => 'kasir',
                'is_active' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'budi@pos.com'],
            [
                'name' => 'Budi',
                'password' => Hash::make('password123'),
                'role' => 'kasir',
                'is_active' => true,
            ]
        );
    }
}
