<?php

namespace App\Http\Controllers;

use App\Models\CompanySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CompanySettingsController extends Controller
{
    /**
     * Show the form for editing company settings.
     */
    public function edit()
    {
        $settings = CompanySetting::getSettings();

        return view('settings.company.edit', compact('settings'));
    }

    /**
     * Update the company settings in storage.
     */
    public function update(Request $request)
    {
        $settings = CompanySetting::getSettings();

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'company_name_short' => 'nullable|string|max:100',
            'company_description' => 'nullable|string|max:1000',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 2MB
            'company_favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,ico|max:1024', // 1MB
            'company_email' => 'required|email|max:255',
            'company_phone' => 'required|string|max:20',
            'company_website' => 'nullable|url|max:255',
            'company_address' => 'required|string|max:500',
            'company_city' => 'required|string|max:100',
            'company_province' => 'nullable|string|max:100',
            'company_postal_code' => 'nullable|string|max:10',
            'company_country' => 'required|string|max:100',
            'npwp_number' => 'nullable|string|max:50',
            'siup_number' => 'nullable|string|max:50',
            'tdp_number' => 'nullable|string|max:50',
            'establishment_date' => 'nullable|date|before:today',
            'legal_entity_type' => 'nullable|string|max:50',
            'contact_person_name' => 'nullable|string|max:255',
            'contact_person_position' => 'nullable|string|max:100',
            'contact_person_phone' => 'nullable|string|max:20',
            'contact_person_email' => 'nullable|email|max:255',
            'bank_name' => 'nullable|string|max:100',
            'bank_account_number' => 'nullable|string|max:50',
            'bank_account_holder' => 'nullable|string|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'business_hours' => 'nullable|string|max:1000',
            'timezone' => 'required|string|max:50',
            'terms_and_conditions' => 'nullable|string',
            'privacy_policy' => 'nullable|string',
            'about_us' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except(['company_logo', 'company_favicon']);

        // Handle logo upload
        if ($request->hasFile('company_logo')) {
            // Delete old logo if exists
            if ($settings->company_logo && Storage::disk('public')->exists($settings->company_logo)) {
                Storage::disk('public')->delete($settings->company_logo);
            }

            $logoFile = $request->file('company_logo');
            $logoName = 'company_logo_' . time() . '.' . $logoFile->getClientOriginalExtension();
            $logoPath = $logoFile->storeAs('company', $logoName, 'public');
            $data['company_logo'] = $logoPath;
        }

        // Handle favicon upload
        if ($request->hasFile('company_favicon')) {
            // Delete old favicon if exists
            if ($settings->company_favicon && Storage::disk('public')->exists($settings->company_favicon)) {
                Storage::disk('public')->delete($settings->company_favicon);
            }

            $faviconFile = $request->file('company_favicon');
            $faviconName = 'company_favicon_' . time() . '.' . $faviconFile->getClientOriginalExtension();
            $faviconPath = $faviconFile->storeAs('company', $faviconName, 'public');
            $data['company_favicon'] = $faviconPath;
        }

        // Update or create settings
        $settings->fill($data);
        $settings->save();

        return redirect()->back()->with('success', 'Company settings updated successfully.');
    }
}
