<?php

namespace App\Models;

use App\Models\Presenters\UserPresenter;
use App\Models\Traits\HasHashedMediaTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use HasFactory;
    use HasRoles;
    use Notifiable;
    use SoftDeletes;
    use HasHashedMediaTrait;
    use UserPresenter;

    protected $guarded = [
        'id',
        'updated_at',
        '_token',
        '_method',
        'password_confirmation',
    ];

    protected $casts = [
        'basic_salary' => 'decimal:2',
        'allowance' => 'decimal:2',
        'bpjs_kesehatan' => 'decimal:2',
        'bpjs_tenaga_kerja' => 'decimal:2',
        'is_active_employee' => 'boolean',
        'status' => 'integer',
        'date_of_birth' => 'datetime',
        'hire_date' => 'datetime',
        'join_date' => 'datetime',
        'probation_end_date' => 'datetime',
        'contract_end_date' => 'datetime',
        'graduation_year' => 'datetime',
        'email_verified_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    // Relationships
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class);
    }

    public function positionLevel()
    {
        return $this->belongsTo(PositionLevel::class);
    }

    public function employmentStatus()
    {
        return $this->belongsTo(EmploymentStatus::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function documents()
    {
        return $this->hasMany(UserDocument::class);
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    public function getEmployeeInfoAttribute()
    {
        return [
            'employee_id' => $this->employee_id,
            'employee_number' => $this->employee_number,
            'department' => $this->department?->name,
            'branch' => $this->branch?->name,
            'job_title' => $this->jobTitle?->name,
            'position_level' => $this->positionLevel?->name,
            'employment_status' => $this->employmentStatus?->name,
        ];
    }

    public function getMaritalStatusLabelAttribute()
    {
        return match($this->marital_status) {
            'single' => 'Belum Menikah',
            'married' => 'Menikah',
            'divorced' => 'Cerai',
            'widowed' => 'Janda/Duda',
            default => $this->marital_status
        };
    }

    public function getEducationLevelLabelAttribute()
    {
        return match($this->education_level) {
            'SD' => 'Sekolah Dasar',
            'SMP' => 'Sekolah Menengah Pertama',
            'SMA' => 'Sekolah Menengah Atas',
            'SMK' => 'Sekolah Menengah Kejuruan',
            'D1' => 'Diploma 1',
            'D2' => 'Diploma 2',
            'D3' => 'Diploma 3',
            'S1' => 'Sarjana',
            'S2' => 'Magister',
            'S3' => 'Doktor',
            default => $this->education_level
        };
    }

    public function getTotalSalaryAttribute()
    {
        return ($this->basic_salary ?? 0) + ($this->allowance ?? 0);
    }

    public function getAgeAttribute()
    {
        return $this->date_of_birth ? $this->date_of_birth->age : null;
    }

    public function getYearsOfServiceAttribute()
    {
        return $this->join_date ? $this->join_date->diffInYears(now()) : null;
    }

    // Scopes
    public function scopeActiveEmployees($query)
    {
        return $query->where('is_active_employee', true);
    }

    public function scopeByBranch($query, $branchId)
    {
        return $query->where('branch_id', $branchId);
    }

    public function scopeByDepartment($query, $departmentId)
    {
        return $query->where('department_id', $departmentId);
    }

    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'password',
        'employee_id',
        'username',
        'mobile',
        'phone',
        'gender',
        'date_of_birth',
        'place_of_birth',
        'nationality',
        'religion',
        'marital_status',
        'blood_type',
        'address',
        'city',
        'postal_code',
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
        'hire_date',
        'probation_end_date',
        'contract_end_date',
        'bank_id',
        'bank_account_number',
        'bank_account_name',
        'basic_salary',
        'allowance',
        'bpjs_kesehatan',
        'bpjs_tenaga_kerja',
        'bpjs_kesehatan_number',
        'bpjs_tenaga_kerja_number',
        'npwp_number',
        'education_level',
        'education_institution',
        'education_major',
        'graduation_year',
        'is_active_employee',
        'notes',
        'avatar',
        'photo_path',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
