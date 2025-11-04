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
        Schema::create('company_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_name_short')->nullable();
            $table->text('company_description')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('company_favicon')->nullable();
            $table->string('company_email');
            $table->string('company_phone');
            $table->string('company_website')->nullable();
            $table->text('company_address');
            $table->string('company_city');
            $table->string('company_province')->nullable();
            $table->string('company_postal_code')->nullable();
            $table->string('company_country')->default('Indonesia');

            // Legal Information
            $table->string('npwp_number')->nullable(); // Tax ID
            $table->string('siup_number')->nullable(); // Business License
            $table->string('tdp_number')->nullable(); // Company Registration
            $table->date('establishment_date')->nullable();
            $table->string('legal_entity_type')->nullable(); // PT, CV, etc.

            // Contact Information
            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_position')->nullable();
            $table->string('contact_person_phone')->nullable();
            $table->string('contact_person_email')->nullable();

            // Banking Information
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_account_holder')->nullable();

            // Social Media
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('twitter_url')->nullable();

            // Business Hours
            $table->string('business_hours')->nullable(); // JSON or text
            $table->string('timezone')->default('Asia/Jakarta');

            // Additional Settings
            $table->text('terms_and_conditions')->nullable();
            $table->text('privacy_policy')->nullable();
            $table->text('about_us')->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_settings');
    }
};
