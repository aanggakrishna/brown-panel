<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $faker = \Faker\Factory::create();

        // Create users with roles for Villa Management System
        $users = [
            [
                'first_name'        => 'Super',
                'last_name'         => 'Admin',
                'name'              => 'Super Admin',
                'email'             => 'superadmin@villa.com',
                'password'          => Hash::make('password'),
                'username'          => 'superadmin',
                'mobile'            => $faker->phoneNumber,
                'date_of_birth'     => $faker->date,
                'avatar'            => 'img/default-avatar.jpg',
                'gender'            => 'Male',
                'email_verified_at' => Carbon::now(),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
                'role'              => 'Super Admin',
            ],
            [
                'first_name'        => 'Villa',
                'last_name'         => 'Manager',
                'name'              => 'Villa Manager',
                'email'             => 'manager@villa.com',
                'password'          => Hash::make('password'),
                'username'          => 'manager',
                'mobile'            => $faker->phoneNumber,
                'date_of_birth'     => $faker->date,
                'avatar'            => 'img/default-avatar.jpg',
                'gender'            => 'Male',
                'email_verified_at' => Carbon::now(),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
                'role'              => 'Manager',
            ],
            [
                'first_name'        => 'Front',
                'last_name'         => 'Desk',
                'name'              => 'Front Desk Receptionist',
                'email'             => 'receptionist@villa.com',
                'password'          => Hash::make('password'),
                'username'          => 'receptionist',
                'mobile'            => $faker->phoneNumber,
                'date_of_birth'     => $faker->date,
                'avatar'            => 'img/default-avatar.jpg',
                'gender'            => 'Female',
                'email_verified_at' => Carbon::now(),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
                'role'              => 'Receptionist',
            ],
            [
                'first_name'        => 'House',
                'last_name'         => 'Keeper',
                'name'              => 'Housekeeping Staff',
                'email'             => 'housekeeping@villa.com',
                'password'          => Hash::make('password'),
                'username'          => 'housekeeping',
                'mobile'            => $faker->phoneNumber,
                'date_of_birth'     => $faker->date,
                'avatar'            => 'img/default-avatar.jpg',
                'gender'            => 'Female',
                'email_verified_at' => Carbon::now(),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
                'role'              => 'Housekeeping',
            ],
            [
                'first_name'        => 'Finance',
                'last_name'         => 'Manager',
                'name'              => 'Accountant',
                'email'             => 'accountant@villa.com',
                'password'          => Hash::make('password'),
                'username'          => 'accountant',
                'mobile'            => $faker->phoneNumber,
                'date_of_birth'     => $faker->date,
                'avatar'            => 'img/default-avatar.jpg',
                'gender'            => 'Male',
                'email_verified_at' => Carbon::now(),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
                'role'              => 'Accountant',
            ],
            [
                'first_name'        => 'Villa',
                'last_name'         => 'Owner',
                'name'              => 'Villa Owner',
                'email'             => 'owner@villa.com',
                'password'          => Hash::make('password'),
                'username'          => 'owner',
                'mobile'            => $faker->phoneNumber,
                'date_of_birth'     => $faker->date,
                'avatar'            => 'img/default-avatar.jpg',
                'gender'            => 'Male',
                'email_verified_at' => Carbon::now(),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
                'role'              => 'Owner',
            ],
        ];

        foreach ($users as $userData) {
            $role = $userData['role'];
            unset($userData['role']);
            
            $user = User::create($userData);
            $user->assignRole($role);
            
            $this->command->info("Created user: {$userData['email']} with role: {$role}");
        }

        Schema::enableForeignKeyConstraints();
    }
}
