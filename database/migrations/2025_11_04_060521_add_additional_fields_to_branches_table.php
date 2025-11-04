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
        Schema::table('branches', function (Blueprint $table) {
            $table->string('fax')->nullable()->after('phone');
            $table->string('website')->nullable()->after('email');
            $table->string('manager_name')->nullable()->after('website');
            $table->string('manager_phone')->nullable()->after('manager_name');
            $table->string('manager_email')->nullable()->after('manager_phone');
            $table->string('contact_person_name')->nullable()->after('manager_email');
            $table->string('contact_person_phone')->nullable()->after('contact_person_name');
            $table->string('contact_person_email')->nullable()->after('contact_person_phone');
            $table->time('opening_time')->nullable()->after('contact_person_email');
            $table->time('closing_time')->nullable()->after('opening_time');
            $table->text('operating_hours')->nullable()->after('closing_time');
            $table->decimal('latitude', 10, 8)->nullable()->after('operating_hours');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            $table->string('branch_type')->nullable()->after('longitude'); // head_office, branch, warehouse, etc.
            $table->integer('employee_count')->default(0)->after('branch_type');
            $table->date('establishment_date')->nullable()->after('employee_count');
            $table->text('notes')->nullable()->after('establishment_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropColumn([
                'fax',
                'website',
                'manager_name',
                'manager_phone',
                'manager_email',
                'contact_person_name',
                'contact_person_phone',
                'contact_person_email',
                'opening_time',
                'closing_time',
                'operating_hours',
                'latitude',
                'longitude',
                'branch_type',
                'employee_count',
                'establishment_date',
                'notes'
            ]);
        });
    }
};
