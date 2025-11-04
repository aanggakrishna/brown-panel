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
        // Seed Roles and Permissions first
        $this->call([
            RolePermissionSeeder::class,
            UserSeeder::class,
            CompanySettingsSeeder::class,
        ]);

        $this->command->info('Database seeding completed!');
    }
}
