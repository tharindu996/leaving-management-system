<?php

namespace Database\Seeders;

use App\Models\Leave;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Leave::factory(10)->create();

        // Create an admin user with a specific email and password
        User::factory()->create([
            'name' => 'Administrator',
            'role' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        // Create an employee user with a specific email and password
        User::factory()->create([
            'name' => 'Employee 1',
            'role' => 'employee',
            'email' => 'employee1@example.com',
            'password' => 'password',
        ]);
    }
}
