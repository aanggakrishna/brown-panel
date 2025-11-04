<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\Department;
use App\Models\JobTitle;
use App\Models\PositionLevel;
use App\Models\EmploymentStatus;
use App\Models\LeaveType;
use App\Models\Shift;

class MasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        Bank::truncate();
        Branch::truncate();
        Department::truncate();
        JobTitle::truncate();
        PositionLevel::truncate();
        EmploymentStatus::truncate();
        LeaveType::truncate();
        Shift::truncate();

        // Banks
        $banks = [
            ['name' => 'Bank Mandiri', 'code' => 'MANDIRI', 'description' => 'Bank Mandiri Indonesia'],
            ['name' => 'Bank BCA', 'code' => 'BCA', 'description' => 'Bank Central Asia'],
            ['name' => 'Bank BNI', 'code' => 'BNI', 'description' => 'Bank Negara Indonesia'],
            ['name' => 'Bank BRI', 'code' => 'BRI', 'description' => 'Bank Rakyat Indonesia'],
            ['name' => 'Bank CIMB Niaga', 'code' => 'CIMB', 'description' => 'CIMB Niaga'],
        ];

        foreach ($banks as $bank) {
            Bank::create($bank);
        }

        // Branches
        $branches = [
            ['name' => 'Villa Ubud', 'code' => 'VU001', 'address' => 'Jl. Raya Ubud, Bali', 'phone' => '0361-123456'],
            ['name' => 'Villa Seminyak', 'code' => 'VS001', 'address' => 'Jl. Seminyak Beach, Bali', 'phone' => '0361-234567'],
            ['name' => 'Villa Canggu', 'code' => 'VC001', 'address' => 'Jl. Pantai Canggu, Bali', 'phone' => '0361-345678'],
            ['name' => 'Villa Nusa Dua', 'code' => 'VND001', 'address' => 'Kawasan Nusa Dua, Bali', 'phone' => '0361-456789'],
        ];

        foreach ($branches as $branch) {
            Branch::create($branch);
        }

        // Departments
        $departments = [
            // Villa Ubud
            ['name' => 'Front Office', 'branch_id' => 1, 'description' => 'Reception and guest services'],
            ['name' => 'Housekeeping', 'branch_id' => 1, 'description' => 'Room cleaning and maintenance'],
            ['name' => 'Food & Beverage', 'branch_id' => 1, 'description' => 'Restaurant and kitchen'],
            ['name' => 'Accounting', 'branch_id' => 1, 'description' => 'Finance and accounting'],

            // Villa Seminyak
            ['name' => 'Front Office', 'branch_id' => 2, 'description' => 'Reception and guest services'],
            ['name' => 'Housekeeping', 'branch_id' => 2, 'description' => 'Room cleaning and maintenance'],

            // Villa Canggu
            ['name' => 'Front Office', 'branch_id' => 3, 'description' => 'Reception and guest services'],
            ['name' => 'Housekeeping', 'branch_id' => 3, 'description' => 'Room cleaning and maintenance'],

            // Villa Nusa Dua
            ['name' => 'Front Office', 'branch_id' => 4, 'description' => 'Reception and guest services'],
            ['name' => 'Housekeeping', 'branch_id' => 4, 'description' => 'Room cleaning and maintenance'],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }

        // Position Levels
        $levels = [
            ['name' => 'Staff', 'level_order' => 1, 'description' => 'Entry level position'],
            ['name' => 'Senior Staff', 'level_order' => 2, 'description' => 'Experienced staff'],
            ['name' => 'Supervisor', 'level_order' => 3, 'description' => 'Team supervisor'],
            ['name' => 'Manager', 'level_order' => 4, 'description' => 'Department manager'],
            ['name' => 'General Manager', 'level_order' => 5, 'description' => 'Branch general manager'],
        ];

        foreach ($levels as $level) {
            PositionLevel::create($level);
        }

        // Job Titles
        $jobTitles = [
            // Front Office positions
            ['name' => 'Receptionist', 'department_id' => 1, 'position_level_id' => 1, 'description' => 'Front desk receptionist'],
            ['name' => 'Guest Relations Officer', 'department_id' => 1, 'position_level_id' => 2, 'description' => 'Guest service specialist'],
            ['name' => 'Front Office Supervisor', 'department_id' => 1, 'position_level_id' => 3, 'description' => 'FO supervisor'],

            // Housekeeping positions
            ['name' => 'Room Attendant', 'department_id' => 2, 'position_level_id' => 1, 'description' => 'Room cleaner'],
            ['name' => 'Housekeeping Supervisor', 'department_id' => 2, 'position_level_id' => 3, 'description' => 'HK supervisor'],

            // F&B positions
            ['name' => 'Waiter', 'department_id' => 3, 'position_level_id' => 1, 'description' => 'Restaurant waiter'],
            ['name' => 'Chef', 'department_id' => 3, 'position_level_id' => 2, 'description' => 'Kitchen chef'],

            // Accounting positions
            ['name' => 'Accountant', 'department_id' => 4, 'position_level_id' => 2, 'description' => 'Finance staff'],
            ['name' => 'Accounting Manager', 'department_id' => 4, 'position_level_id' => 4, 'description' => 'Finance manager'],
        ];

        foreach ($jobTitles as $jobTitle) {
            JobTitle::create($jobTitle);
        }

        // Employment Status
        $statuses = [
            ['name' => 'Permanent', 'description' => 'Permanent employee'],
            ['name' => 'Contract', 'description' => 'Contract employee'],
            ['name' => 'Probation', 'description' => 'Employee on probation period'],
            ['name' => 'Internship', 'description' => 'Intern'],
            ['name' => 'Part Time', 'description' => 'Part time employee'],
        ];

        foreach ($statuses as $status) {
            EmploymentStatus::create($status);
        }

        // Leave Types
        $leaveTypes = [
            ['name' => 'Annual Leave', 'max_days_per_year' => 12, 'is_paid' => true, 'description' => 'Paid annual leave'],
            ['name' => 'Sick Leave', 'max_days_per_year' => 14, 'is_paid' => true, 'description' => 'Paid sick leave'],
            ['name' => 'Unpaid Leave', 'max_days_per_year' => 30, 'is_paid' => false, 'description' => 'Leave without pay'],
            ['name' => 'Maternity Leave', 'max_days_per_year' => 90, 'is_paid' => true, 'description' => 'Maternity leave'],
            ['name' => 'Paternity Leave', 'max_days_per_year' => 3, 'is_paid' => true, 'description' => 'Paternity leave'],
            ['name' => 'Emergency Leave', 'max_days_per_year' => 5, 'is_paid' => true, 'description' => 'Emergency leave'],
        ];

        foreach ($leaveTypes as $leaveType) {
            LeaveType::create($leaveType);
        }

        // Shifts
        $shifts = [
            ['name' => 'Morning Shift', 'start_time' => '07:00:00', 'end_time' => '15:00:00', 'description' => 'Morning shift'],
            ['name' => 'Day Shift', 'start_time' => '08:00:00', 'end_time' => '16:00:00', 'description' => 'Regular day shift'],
            ['name' => 'Afternoon Shift', 'start_time' => '15:00:00', 'end_time' => '23:00:00', 'description' => 'Afternoon shift'],
            ['name' => 'Night Shift', 'start_time' => '23:00:00', 'end_time' => '07:00:00', 'description' => 'Night shift'],
            ['name' => 'Full Day', 'start_time' => '08:00:00', 'end_time' => '17:00:00', 'description' => 'Full day shift with 1 hour break'],
        ];

        foreach ($shifts as $shift) {
            Shift::create($shift);
        }
    }
}
