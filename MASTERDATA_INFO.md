# Master Data HRIS System

## Overview
This is a comprehensive Master Data management system for Villa HRIS with 8 core modules. All modules use server-side DataTables with soft deletes.

## Modules

### 1. Banks
**Route:** `/banks`  
**Purpose:** Manage bank information for employee salary payments  
**Fields:**
- Name
- Code (unique)
- Description
- Status (Active/Inactive)

**Sample Data:**
- Bank Mandiri (MANDIRI)
- Bank BCA (BCA)
- Bank BNI (BNI)
- Bank BRI (BRI)
- Bank CIMB Niaga (CIMB)

---

### 2. Branches
**Route:** `/branches`  
**Purpose:** Manage villa branch locations  
**Fields:**
- Name
- Code (unique)
- Address
- Phone
- Status (Active/Inactive)

**Sample Data:**
- Villa Ubud (VU001)
- Villa Seminyak (VS001)
- Villa Canggu (VC001)
- Villa Nusa Dua (VND001)

---

### 3. Departments
**Route:** `/departments`  
**Purpose:** Manage departments within each branch  
**Fields:**
- Name
- Branch (relationship)
- Description
- Status (Active/Inactive)

**Sample Data:**
- Front Office
- Housekeeping
- Food & Beverage
- Accounting

---

### 4. Job Titles
**Route:** `/job-titles`  
**Purpose:** Manage job positions with department and level  
**Fields:**
- Name
- Department (relationship)
- Branch (through department)
- Position Level (relationship)
- Description
- Status (Active/Inactive)

**Sample Data:**
- Receptionist (Front Office, Staff level)
- Guest Relations Officer (Front Office, Senior Staff)
- Room Attendant (Housekeeping, Staff level)
- Housekeeping Supervisor (Housekeeping, Supervisor)
- Waiter (F&B, Staff level)
- Chef (F&B, Senior Staff)
- Accountant (Accounting, Senior Staff)
- Accounting Manager (Accounting, Manager)

---

### 5. Position Levels
**Route:** `/position-levels`  
**Purpose:** Manage hierarchical position levels  
**Fields:**
- Name
- Level Order (1-5)
- Description
- Status (Active/Inactive)

**Sample Data:**
1. Staff (Entry level)
2. Senior Staff (Experienced)
3. Supervisor (Team leader)
4. Manager (Department head)
5. General Manager (Branch head)

---

### 6. Employment Status
**Route:** `/employment-statuses`  
**Purpose:** Manage employee contract types  
**Fields:**
- Name
- Description
- Status (Active/Inactive)

**Sample Data:**
- Permanent
- Contract
- Probation
- Internship
- Part Time

---

### 7. Leave Types
**Route:** `/leave-types`  
**Purpose:** Manage types of leave/time off  
**Fields:**
- Name
- Max Days Per Year
- Is Paid (Yes/No)
- Description
- Status (Active/Inactive)

**Sample Data:**
- Annual Leave (12 days, Paid)
- Sick Leave (14 days, Paid)
- Unpaid Leave (30 days, Unpaid)
- Maternity Leave (90 days, Paid)
- Paternity Leave (3 days, Paid)
- Emergency Leave (5 days, Paid)

---

### 8. Shifts
**Route:** `/shifts`  
**Purpose:** Manage work shift schedules  
**Fields:**
- Name
- Start Time
- End Time
- Description
- Status (Active/Inactive)

**Sample Data:**
- Morning Shift (07:00-15:00)
- Day Shift (08:00-16:00)
- Afternoon Shift (15:00-23:00)
- Night Shift (23:00-07:00)
- Full Day (08:00-17:00 with 1 hour break)

---

## Technical Details

### Common Features
- ✅ Soft Deletes on all models
- ✅ Active/Inactive status flag
- ✅ Server-side DataTables with search and pagination
- ✅ Action buttons with emoji icons (👁️ View, ✏️ Edit, 🗑️ Delete)
- ✅ Relationship displays where applicable

### Database Structure
All tables include:
- `id` - Primary key
- `name` - Main identifier
- `description` - Additional details (nullable)
- `is_active` - Status flag (default: true)
- `created_at`, `updated_at` - Timestamps
- `deleted_at` - Soft delete timestamp

### Controllers
All controllers use:
- Yajra DataTables Facade pattern
- Standard CRUD methods
- Server-side processing for performance

### Views
All index views include:
- DataTables initialization with jQuery
- Responsive table layout
- Bootstrap 5 styling
- CoreUI card components

### Navigation
Two-level sidebar menu structure:
```
Master Data (nav-title)
└── Master Data HRIS (nav-group)
    ├── Banks
    ├── Branches
    ├── Departments
    ├── Job Titles
    ├── Position Levels
    ├── Employment Status
    ├── Leave Types
    └── Shifts
```

---

## Seeding Data

To populate master data with sample data:
```bash
php artisan db:seed --class=MasterDataSeeder
```

This will create:
- 5 Banks
- 4 Branches
- 10 Departments (across branches)
- 9 Job Titles
- 5 Position Levels
- 5 Employment Statuses
- 6 Leave Types
- 5 Shifts

---

## Relationships

```
Branch (1) → (many) Department
Department (1) → (many) JobTitle
PositionLevel (1) → (many) JobTitle

JobTitle belongs to:
  - Department
  - PositionLevel
  
JobTitle has (through Department):
  - Branch
```

---

## Routes

All routes use resource controller pattern:
```php
Route::resource('banks', BankController::class);
Route::resource('branches', BranchController::class);
Route::resource('departments', DepartmentController::class);
Route::resource('job-titles', JobTitleController::class);
Route::resource('position-levels', PositionLevelController::class);
Route::resource('employment-statuses', EmploymentStatusController::class);
Route::resource('leave-types', LeaveTypeController::class);
Route::resource('shifts', ShiftController::class);
```

This provides standard CRUD routes:
- `GET /banks` - Index (list)
- `GET /banks/create` - Create form
- `POST /banks` - Store
- `GET /banks/{id}` - Show
- `GET /banks/{id}/edit` - Edit form
- `PUT/PATCH /banks/{id}` - Update
- `DELETE /banks/{id}` - Destroy (soft delete)

---

## Next Steps (Not Yet Implemented)

1. **Create/Edit Forms** - Form views for adding and editing records
2. **Validation** - Form request validation classes
3. **Authorization** - Permission checks using Spatie Permission
4. **API Endpoints** - RESTful API for mobile/external access
5. **Export** - Excel/PDF export functionality
6. **Audit Log** - Track changes to master data
7. **Bulk Import** - CSV/Excel import for bulk data entry

---

## Files Created

### Models (8)
- `app/Models/Bank.php`
- `app/Models/Branch.php`
- `app/Models/Department.php`
- `app/Models/JobTitle.php`
- `app/Models/PositionLevel.php`
- `app/Models/EmploymentStatus.php`
- `app/Models/LeaveType.php`
- `app/Models/Shift.php`

### Migrations (8)
- `database/migrations/*_create_banks_table.php`
- `database/migrations/*_create_branches_table.php`
- `database/migrations/*_create_departments_table.php`
- `database/migrations/*_create_job_titles_table.php`
- `database/migrations/*_create_position_levels_table.php`
- `database/migrations/*_create_employment_statuses_table.php`
- `database/migrations/*_create_leave_types_table.php`
- `database/migrations/*_create_shifts_table.php`

### Controllers (8)
- `app/Http/Controllers/BankController.php`
- `app/Http/Controllers/BranchController.php`
- `app/Http/Controllers/DepartmentController.php`
- `app/Http/Controllers/JobTitleController.php`
- `app/Http/Controllers/PositionLevelController.php`
- `app/Http/Controllers/EmploymentStatusController.php`
- `app/Http/Controllers/LeaveTypeController.php`
- `app/Http/Controllers/ShiftController.php`

### Views (8)
- `resources/views/masterdata/banks/index.blade.php`
- `resources/views/masterdata/branches/index.blade.php`
- `resources/views/masterdata/departments/index.blade.php`
- `resources/views/masterdata/job-titles/index.blade.php`
- `resources/views/masterdata/position-levels/index.blade.php`
- `resources/views/masterdata/employment-statuses/index.blade.php`
- `resources/views/masterdata/leave-types/index.blade.php`
- `resources/views/masterdata/shifts/index.blade.php`

### Seeders (1)
- `database/seeders/MasterDataSeeder.php`

### Configuration
- `routes/web.php` - Updated with 8 resource routes
- `resources/views/layouts/navigation.blade.php` - Updated with Master Data menu

---

Created: November 4, 2025  
Version: 1.0
