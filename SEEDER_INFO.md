# Villa Management System - Seeder Information

## Overview
Database seeder untuk sistem manajemen villa dengan roles dan permissions yang lengkap.

## Roles Created

### 1. Super Admin
**Email:** superadmin@villa.com  
**Password:** password  
**Username:** superadmin  
**Access:** Full access ke seluruh sistem

### 2. Manager
**Email:** manager@villa.com  
**Password:** password  
**Username:** manager  
**Access:** 
- Manage villas (list, view, edit)
- Manage bookings (full CRUD + approve/cancel)
- Manage guests (list, create, edit, view)
- View and verify payments
- View staff
- Manage maintenance
- View and export all reports

### 3. Receptionist
**Email:** receptionist@villa.com  
**Password:** password  
**Username:** receptionist  
**Access:**
- View villas
- Manage bookings (CRUD)
- Manage guests (CRUD)
- Manage payments (list, create, view)

### 4. Housekeeping
**Email:** housekeeping@villa.com  
**Password:** password  
**Username:** housekeeping  
**Access:**
- View villas
- Manage maintenance (list, create, view)

### 5. Accountant
**Email:** accountant@villa.com  
**Password:** password  
**Username:** accountant  
**Access:**
- View bookings
- Full payment management + verification
- View and export financial reports

### 6. Owner
**Email:** owner@villa.com  
**Password:** password  
**Username:** owner  
**Access:**
- View-only access to:
  - Villas
  - Bookings
  - Guests
  - Payments
- Full access to all reports

### 7. Guest
**Role untuk customer portal (belum ada user)**  
**Access:**
- View own bookings
- View own payments

## Permissions List

### Villa Management (5 permissions)
- `villa-list` - Lihat daftar villa
- `villa-create` - Buat villa baru
- `villa-edit` - Edit villa
- `villa-delete` - Hapus villa
- `villa-view` - Lihat detail villa

### Booking Management (7 permissions)
- `booking-list` - Lihat daftar booking
- `booking-create` - Buat booking baru
- `booking-edit` - Edit booking
- `booking-delete` - Hapus booking
- `booking-view` - Lihat detail booking
- `booking-approve` - Approve booking
- `booking-cancel` - Cancel booking

### Guest Management (5 permissions)
- `guest-list` - Lihat daftar tamu
- `guest-create` - Daftar tamu baru
- `guest-edit` - Edit data tamu
- `guest-delete` - Hapus tamu
- `guest-view` - Lihat detail tamu

### Payment Management (6 permissions)
- `payment-list` - Lihat daftar pembayaran
- `payment-create` - Catat pembayaran
- `payment-edit` - Edit pembayaran
- `payment-delete` - Hapus pembayaran
- `payment-view` - Lihat detail pembayaran
- `payment-verify` - Verifikasi pembayaran

### Staff Management (5 permissions)
- `staff-list` - Lihat daftar staff
- `staff-create` - Tambah staff
- `staff-edit` - Edit staff
- `staff-delete` - Hapus staff
- `staff-view` - Lihat detail staff

### Maintenance Management (5 permissions)
- `maintenance-list` - Lihat daftar maintenance
- `maintenance-create` - Buat laporan maintenance
- `maintenance-edit` - Edit maintenance
- `maintenance-delete` - Hapus maintenance
- `maintenance-view` - Lihat detail maintenance

### Report Management (4 permissions)
- `report-view` - Lihat reports
- `report-export` - Export reports
- `report-financial` - Lihat laporan keuangan
- `report-occupancy` - Lihat laporan occupancy

### User Management (5 permissions)
- `user-list` - Lihat daftar user
- `user-create` - Buat user baru
- `user-edit` - Edit user
- `user-delete` - Hapus user
- `user-view` - Lihat detail user

### Role & Permission Management (7 permissions)
- `role-list` - Lihat daftar role
- `role-create` - Buat role baru
- `role-edit` - Edit role
- `role-delete` - Hapus role
- `permission-list` - Lihat daftar permission
- `permission-create` - Buat permission baru
- `permission-edit` - Edit permission
- `permission-delete` - Hapus permission

### Settings (2 permissions)
- `settings-view` - Lihat settings
- `settings-edit` - Edit settings

**Total: 52 Permissions**

## Running Seeders

### Reset Database dan Run All Seeders
```bash
php artisan migrate:fresh --seed
```

### Run Specific Seeder
```bash
php artisan db:seed --class=RolePermissionSeeder
php artisan db:seed --class=UserSeeder
```

### Run dalam Production (tanpa reset)
```bash
php artisan db:seed
```

## File Structure

```
database/
├── seeders/
│   ├── DatabaseSeeder.php (Main seeder)
│   ├── RolePermissionSeeder.php (Roles & Permissions)
│   └── UserSeeder.php (Demo users with roles)
```

## Login Information

Untuk testing, gunakan salah satu credentials berikut:

| Role | Email | Password | Username |
|------|-------|----------|----------|
| Super Admin | superadmin@villa.com | password | superadmin |
| Manager | manager@villa.com | password | manager |
| Receptionist | receptionist@villa.com | password | receptionist |
| Housekeeping | housekeeping@villa.com | password | housekeeping |
| Accountant | accountant@villa.com | password | accountant |
| Owner | owner@villa.com | password | owner |

## Notes

1. **Password Default**: Semua user menggunakan password `password` untuk kemudahan testing
2. **Change in Production**: Pastikan ganti password sebelum production
3. **Guest Role**: Role "Guest" sudah dibuat tapi belum ada user, bisa digunakan untuk customer portal
4. **Permissions**: Permissions dibuat modular sehingga mudah untuk assign ke role baru
5. **Scalable**: Mudah menambah permissions atau roles baru sesuai kebutuhan

## Extending Seeders

### Menambah Permission Baru
Edit `RolePermissionSeeder.php` dan tambahkan ke array `$permissions`:
```php
$permissions = [
    // ... existing permissions
    'new-permission-name',
];
```

### Menambah Role Baru
Tambahkan setelah role yang sudah ada:
```php
$newRole = Role::create(['name' => 'New Role']);
$newRole->givePermissionTo([
    'permission-1',
    'permission-2',
]);
```

### Menambah User Baru
Edit `UserSeeder.php` dan tambahkan ke array `$users`:
```php
[
    'first_name'        => 'First',
    'last_name'         => 'Last',
    'name'              => 'Full Name',
    'email'             => 'email@villa.com',
    'password'          => Hash::make('password'),
    'username'          => 'username',
    // ... other fields
    'role'              => 'Role Name',
],
```

---

**Created**: January 2025  
**Last Updated**: January 2025  
**Author**: Laravel CoreUI Villa Management Team
