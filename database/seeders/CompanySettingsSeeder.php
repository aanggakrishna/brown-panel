<?php

namespace Database\Seeders;

use App\Models\CompanySetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanySetting::create([
            'company_name' => 'PT. Example Company',
            'company_name_short' => 'PT. Example',
            'company_description' => 'Leading company in technology and innovation solutions.',
            'company_email' => 'info@examplecompany.com',
            'company_phone' => '+62 21 1234 5678',
            'company_website' => 'https://www.examplecompany.com',
            'company_address' => 'Jl. Sudirman No. 123',
            'company_city' => 'Jakarta Pusat',
            'company_province' => 'DKI Jakarta',
            'company_postal_code' => '10230',
            'company_country' => 'Indonesia',
            'npwp_number' => '01.234.567.8-123.000',
            'siup_number' => '123/12-34/PM.01/2023',
            'tdp_number' => '1234567890123',
            'establishment_date' => '2020-01-15',
            'legal_entity_type' => 'PT',
            'contact_person_name' => 'John Doe',
            'contact_person_position' => 'HR Manager',
            'contact_person_phone' => '+62 812 3456 7890',
            'contact_person_email' => 'hr@examplecompany.com',
            'bank_name' => 'Bank Central Asia',
            'bank_account_number' => '1234567890',
            'bank_account_holder' => 'PT. Example Company',
            'facebook_url' => 'https://facebook.com/examplecompany',
            'instagram_url' => 'https://instagram.com/examplecompany',
            'linkedin_url' => 'https://linkedin.com/company/examplecompany',
            'twitter_url' => 'https://twitter.com/examplecompany',
            'business_hours' => 'Monday - Friday: 08:00 - 17:00',
            'timezone' => 'Asia/Jakarta',
            'terms_and_conditions' => 'Default terms and conditions content.',
            'privacy_policy' => 'Default privacy policy content.',
            'about_us' => 'About our company content.',
            'is_active' => true
        ]);
    }
}
