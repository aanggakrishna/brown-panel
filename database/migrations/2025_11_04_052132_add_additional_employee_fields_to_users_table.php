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
            // Add missing fields that are used in the forms
            $table->string('phone')->nullable()->after('mobile');
            $table->string('city')->nullable()->after('address');
            $table->string('postal_code')->nullable()->after('city');
            $table->date('hire_date')->nullable()->after('join_date');
            $table->decimal('bpjs_kesehatan', 15, 2)->nullable()->after('allowance');
            $table->decimal('bpjs_tenaga_kerja', 15, 2)->nullable()->after('bpjs_kesehatan');
            $table->string('bpjs_kesehatan_number')->nullable()->after('bpjs_tenaga_kerja');
            $table->string('bpjs_tenaga_kerja_number')->nullable()->after('bpjs_kesehatan_number');
            $table->string('photo_path')->nullable()->after('avatar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'city',
                'postal_code',
                'hire_date',
                'bpjs_kesehatan',
                'bpjs_tenaga_kerja',
                'bpjs_kesehatan_number',
                'bpjs_tenaga_kerja_number',
                'photo_path'
            ]);
        });
    }
};
