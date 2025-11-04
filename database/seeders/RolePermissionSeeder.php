<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions = [
            // Villa Management
            'villa-list',
            'villa-create',
            'villa-edit',
            'villa-delete',
            'villa-view',
            
            // Booking Management
            'booking-list',
            'booking-create',
            'booking-edit',
            'booking-delete',
            'booking-view',
            'booking-approve',
            'booking-cancel',
            
            // Guest Management
            'guest-list',
            'guest-create',
            'guest-edit',
            'guest-delete',
            'guest-view',
            
            // Payment Management
            'payment-list',
            'payment-create',
            'payment-edit',
            'payment-delete',
            'payment-view',
            'payment-verify',
            
            // Staff Management
            'staff-list',
            'staff-create',
            'staff-edit',
            'staff-delete',
            'staff-view',
            
            // Maintenance Management
            'maintenance-list',
            'maintenance-create',
            'maintenance-edit',
            'maintenance-delete',
            'maintenance-view',
            
            // Report Management
            'report-view',
            'report-export',
            'report-financial',
            'report-occupancy',
            
            // User Management
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'user-view',
            
            // Role & Permission Management
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            
            // Settings
            'settings-view',
            'settings-edit',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create Roles and Assign Permissions

        // 1. Super Admin - Full Access
        $superAdmin = Role::create(['name' => 'Super Admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // 2. Manager - Manage villa operations
        $manager = Role::create(['name' => 'Manager']);
        $manager->givePermissionTo([
            'villa-list', 'villa-view', 'villa-edit',
            'booking-list', 'booking-create', 'booking-edit', 'booking-view', 'booking-approve', 'booking-cancel',
            'guest-list', 'guest-create', 'guest-edit', 'guest-view',
            'payment-list', 'payment-view', 'payment-verify',
            'staff-list', 'staff-view',
            'maintenance-list', 'maintenance-create', 'maintenance-edit', 'maintenance-view',
            'report-view', 'report-export', 'report-financial', 'report-occupancy',
        ]);

        // 3. Receptionist - Handle bookings and guests
        $receptionist = Role::create(['name' => 'Receptionist']);
        $receptionist->givePermissionTo([
            'villa-list', 'villa-view',
            'booking-list', 'booking-create', 'booking-edit', 'booking-view',
            'guest-list', 'guest-create', 'guest-edit', 'guest-view',
            'payment-list', 'payment-create', 'payment-view',
        ]);

        // 4. Housekeeping - Manage villa maintenance
        $housekeeping = Role::create(['name' => 'Housekeeping']);
        $housekeeping->givePermissionTo([
            'villa-list', 'villa-view',
            'maintenance-list', 'maintenance-create', 'maintenance-view',
        ]);

        // 5. Accountant - Handle payments and reports
        $accountant = Role::create(['name' => 'Accountant']);
        $accountant->givePermissionTo([
            'booking-list', 'booking-view',
            'payment-list', 'payment-create', 'payment-edit', 'payment-view', 'payment-verify',
            'report-view', 'report-export', 'report-financial',
        ]);

        // 6. Owner - View reports only
        $owner = Role::create(['name' => 'Owner']);
        $owner->givePermissionTo([
            'villa-list', 'villa-view',
            'booking-list', 'booking-view',
            'guest-list', 'guest-view',
            'payment-list', 'payment-view',
            'report-view', 'report-export', 'report-financial', 'report-occupancy',
        ]);

        // 7. Guest - Limited access (for customer portal)
        $guest = Role::create(['name' => 'Guest']);
        $guest->givePermissionTo([
            'booking-view',
            'payment-view',
        ]);

        $this->command->info('Roles and Permissions seeded successfully!');
        $this->command->info('Created Roles: Super Admin, Manager, Receptionist, Housekeeping, Accountant, Owner, Guest');
        $this->command->info('Total Permissions: ' . count($permissions));
    }
}
