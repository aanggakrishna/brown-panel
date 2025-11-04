<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'description',
        'address',
        'city',
        'province',
        'postal_code',
        'phone',
        'fax',
        'email',
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
        'notes',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'opening_time' => 'datetime:H:i',
        'closing_time' => 'datetime:H:i',
        'establishment_date' => 'date',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'employee_count' => 'integer',
    ];

    /**
     * Get the formatted address
     */
    public function getFormattedAddressAttribute()
    {
        $address = $this->address;
        if ($this->city) {
            $address .= ', ' . $this->city;
        }
        if ($this->province) {
            $address .= ', ' . $this->province;
        }
        if ($this->postal_code) {
            $address .= ' ' . $this->postal_code;
        }
        return $address;
    }

    /**
     * Get the formatted contact info
     */
    public function getFormattedContactAttribute()
    {
        $contact = [];
        if ($this->phone) {
            $contact[] = 'Phone: ' . $this->phone;
        }
        if ($this->fax) {
            $contact[] = 'Fax: ' . $this->fax;
        }
        if ($this->email) {
            $contact[] = 'Email: ' . $this->email;
        }
        if ($this->website) {
            $contact[] = 'Website: ' . $this->website;
        }
        return implode(' | ', $contact);
    }

    /**
     * Get the operating hours display
     */
    public function getOperatingHoursDisplayAttribute()
    {
        if ($this->operating_hours) {
            return $this->operating_hours;
        }

        if ($this->opening_time && $this->closing_time) {
            return $this->opening_time->format('H:i') . ' - ' . $this->closing_time->format('H:i');
        }

        return 'Not specified';
    }

    /**
     * Get branch type label
     */
    public function getBranchTypeLabelAttribute()
    {
        $types = [
            'head_office' => 'Head Office',
            'branch' => 'Branch Office',
            'warehouse' => 'Warehouse',
            'store' => 'Store/Outlet',
            'factory' => 'Factory',
            'workshop' => 'Workshop',
            'other' => 'Other'
        ];

        return $types[$this->branch_type] ?? 'Not specified';
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
