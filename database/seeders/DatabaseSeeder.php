<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::factory()->create([
            'name' => 'Test Company 1',
            'email' => 'test@company1.com',
            'role' => 1,
            'password' => bcrypt('admin'),
            'approved' => 1
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test Company 2',
            'email' => 'test@company2.com',
            'role' => 1,
            'password' => bcrypt('admin'),
            'approved' => 1
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test Company 3',
            'email' => 'test@company3.com',
            'role' => 1,
            'password' => bcrypt('admin'),
            'approved' => 1
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test User 1',
            'email' => 'test@user1.com',
            'role' => 2,
            'password' => bcrypt('user'),
            'career_role' => 1,
            'selected_company' => 1,
            'nic' => '123456798v',
            'eid' => 'TC1-0001',
            'approved' => 0
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test@user2.com',
            'role' => 2,
            'password' => bcrypt('user'),
            'career_role' => 4,
            'selected_company' => 1,
            'nic' => '123456798v',
            'eid' => 'TC1-0002',
            'approved' => 0
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test User 3',
            'email' => 'test@user3.com',
            'role' => 2,
            'password' => bcrypt('user'),
            'career_role' => 4,
            'selected_company' => 2,
            'nic' => '123456798v',
            'eid' => 'TC2-0001',
            'approved' => 0
        ]);
    }
}
