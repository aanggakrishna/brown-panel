<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Basic Information
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username',
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date|before:today',
            'employee_id' => 'nullable|string|max:50|unique:users,employee_id',

            // Employment Information
            'branch_id' => 'nullable|exists:branches,id',
            'department_id' => 'nullable|exists:departments,id',
            'job_title_id' => 'nullable|exists:job_titles,id',
            'employment_status_id' => 'nullable|exists:employment_statuses,id',
            'position_level_id' => 'nullable|exists:position_levels,id',
            'hire_date' => 'nullable|date|before_or_equal:today',

            // Salary Information
            'basic_salary' => 'nullable|numeric|min:0',
            'allowance' => 'nullable|numeric|min:0',
            'bpjs_kesehatan' => 'nullable|numeric|min:0',
            'bpjs_tenaga_kerja' => 'nullable|numeric|min:0',

            // BPJS Numbers
            'bpjs_kesehatan_number' => 'nullable|string|max:50',
            'bpjs_tenaga_kerja_number' => 'nullable|string|max:50',

            // Address Information
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',

            // Photo
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max

            // Role
            'role' => 'required|string|exists:roles,name',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'branch_id' => 'branch',
            'department_id' => 'department',
            'job_title_id' => 'job title',
            'employment_status_id' => 'employment status',
            'position_level_id' => 'position level',
            'bpjs_kesehatan' => 'BPJS kesehatan',
            'bpjs_tenaga_kerja' => 'BPJS tenaga kerja',
            'bpjs_kesehatan_number' => 'BPJS kesehatan number',
            'bpjs_tenaga_kerja_number' => 'BPJS tenaga kerja number',
        ];
    }
}
