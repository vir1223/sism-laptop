<?php

namespace Database\Seeders;

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
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Create admin user if not exists
        User::firstOrCreate(
            ['username' => 'admin1'],
            [
                'username' => 'admin1',
                'password' => bcrypt('punyafairuz'),
                'role' => 'admin',
            ]
        );
    }
}
