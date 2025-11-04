<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CompanySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'company_name_short',
        'company_description',
        'company_logo',
        'company_favicon',
        'company_email',
        'company_phone',
        'company_website',
        'company_address',
        'company_city',
        'company_province',
        'company_postal_code',
        'company_country',
        'npwp_number',
        'siup_number',
        'tdp_number',
        'establishment_date',
        'legal_entity_type',
        'contact_person_name',
        'contact_person_position',
        'contact_person_phone',
        'contact_person_email',
        'bank_name',
        'bank_account_number',
        'bank_account_holder',
        'facebook_url',
        'instagram_url',
        'linkedin_url',
        'twitter_url',
        'business_hours',
        'timezone',
        'terms_and_conditions',
        'privacy_policy',
        'about_us',
        'is_active'
    ];

    protected $casts = [
        'establishment_date' => 'date',
        'is_active' => 'boolean',
        'business_hours' => 'array'
    ];

    /**
     * Get the company logo URL
     */
    public function getCompanyLogoUrlAttribute()
    {
        return $this->company_logo ? Storage::url($this->company_logo) : null;
    }

    /**
     * Get the company favicon URL
     */
    public function getCompanyFaviconUrlAttribute()
    {
        return $this->company_favicon ? Storage::url($this->company_favicon) : null;
    }

    /**
     * Get the first (and should be only) company setting record
     */
    public static function getSettings()
    {
        return static::first() ?? new static();
    }

    /**
     * Get formatted address
     */
    public function getFormattedAddressAttribute()
    {
        $address = $this->company_address;
        if ($this->company_city) {
            $address .= ', ' . $this->company_city;
        }
        if ($this->company_province) {
            $address .= ', ' . $this->company_province;
        }
        if ($this->company_postal_code) {
            $address .= ' ' . $this->company_postal_code;
        }
        if ($this->company_country) {
            $address .= ', ' . $this->company_country;
        }
        return $address;
    }

    /**
     * Get formatted contact info
     */
    public function getFormattedContactAttribute()
    {
        $contact = [];
        if ($this->company_phone) {
            $contact[] = 'Phone: ' . $this->company_phone;
        }
        if ($this->company_email) {
            $contact[] = 'Email: ' . $this->company_email;
        }
        if ($this->company_website) {
            $contact[] = 'Website: ' . $this->company_website;
        }
        return implode(' | ', $contact);
    }
}
