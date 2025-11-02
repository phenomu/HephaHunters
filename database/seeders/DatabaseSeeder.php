<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin (buat hanya jika belum ada)
        User::firstOrCreate(
            ['email' => 'admin@hepha.com'],
            [
                'name' => 'Admin Hepha',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Hunter (buat hanya jika belum ada)
        User::firstOrCreate(
            ['email' => 'hunter@hepha.com'],
            [
                'name' => 'Hunter 01',
                'password' => Hash::make('hunter123'),
                'role' => 'hunter',
            ]
        );
    }
}

