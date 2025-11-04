<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Personal Information
            $table->string('employee_id')->nullable()->unique()->after('id'); // NIK
            $table->string('place_of_birth')->nullable()->after('date_of_birth');
            $table->string('nationality')->default('Indonesia')->after('place_of_birth');
            $table->string('religion')->nullable()->after('nationality');
            $table->string('marital_status')->nullable()->after('religion'); // single, married, divorced, widowed
            $table->string('blood_type')->nullable()->after('marital_status'); // A, B, AB, O

            // Contact Information
            $table->text('address')->nullable()->after('mobile');
            $table->string('emergency_contact_name')->nullable()->after('address');
            $table->string('emergency_contact_phone')->nullable()->after('emergency_contact_name');
            $table->string('emergency_contact_relation')->nullable()->after('emergency_contact_phone');

            // Employment Information
            $table->foreignId('branch_id')->nullable()->constrained('branches')->onDelete('set null')->after('emergency_contact_relation');
            $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('set null')->after('branch_id');
            $table->foreignId('job_title_id')->nullable()->constrained('job_titles')->onDelete('set null')->after('department_id');
            $table->foreignId('position_level_id')->nullable()->constrained('position_levels')->onDelete('set null')->after('job_title_id');
            $table->foreignId('employment_status_id')->nullable()->constrained('employment_statuses')->onDelete('set null')->after('position_level_id');
            $table->string('employee_number')->nullable()->unique()->after('employment_status_id');
            $table->date('join_date')->nullable()->after('employee_number');
            $table->date('probation_end_date')->nullable()->after('join_date');
            $table->date('contract_end_date')->nullable()->after('probation_end_date');

            // Financial Information
            $table->foreignId('bank_id')->nullable()->constrained('banks')->onDelete('set null')->after('contract_end_date');
            $table->string('bank_account_number')->nullable()->after('bank_id');
            $table->string('bank_account_name')->nullable()->after('bank_account_number');
            $table->decimal('basic_salary', 15, 2)->nullable()->after('bank_account_name');
            $table->decimal('allowance', 15, 2)->nullable()->after('basic_salary');
            $table->string('bpjs_health_number')->nullable()->after('allowance');
            $table->string('bpjs_employment_number')->nullable()->after('bpjs_health_number');
            $table->string('npwp_number')->nullable()->after('bpjs_employment_number');

            // Education Information
            $table->string('education_level')->nullable()->after('npwp_number'); // SD, SMP, SMA, D1, D2, D3, S1, S2, S3
            $table->string('education_institution')->nullable()->after('education_level');
            $table->string('education_major')->nullable()->after('education_institution');
            $table->year('graduation_year')->nullable()->after('education_major');

            // Additional fields
            $table->boolean('is_active_employee')->default(true)->after('status');
            $table->text('notes')->nullable()->after('is_active_employee');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['branch_id']);
            $table->dropForeign(['department_id']);
            $table->dropForeign(['job_title_id']);
            $table->dropForeign(['position_level_id']);
            $table->dropForeign(['employment_status_id']);
            $table->dropForeign(['bank_id']);

            $table->dropColumn([
                'employee_id',
                'place_of_birth',
                'nationality',
                'religion',
                'marital_status',
                'blood_type',
                'address',
                'emergency_contact_name',
                'emergency_contact_phone',
                'emergency_contact_relation',
                'branch_id',
                'department_id',
                'job_title_id',
                'position_level_id',
                'employment_status_id',
                'employee_number',
                'join_date',
                'probation_end_date',
                'contract_end_date',
                'bank_id',
                'bank_account_number',
                'bank_account_name',
                'basic_salary',
                'allowance',
                'bpjs_health_number',
                'bpjs_employment_number',
                'npwp_number',
                'education_level',
                'education_institution',
                'education_major',
                'graduation_year',
                'is_active_employee',
                'notes'
            ]);
        });
    }
};
