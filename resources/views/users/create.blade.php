@extends('layouts.app')

@section('title')
Create User
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">Add New Employee</h5>
                    <h6 class="card-subtitle text-muted">Create new employee profile with complete information.</h6>
                </div>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    <i class="cil-arrow-left me-1"></i> Back to Users
                </a>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Basic Information -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="text-primary mb-3">
                            <i class="cil-user me-2"></i>Basic Information
                        </h6>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" placeholder="Full Name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" placeholder="Email address" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                            <input value="{{ old('username') }}" type="text" class="form-control @error('username') is-invalid @enderror"
                                   name="username" placeholder="Username" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input value="{{ old('phone') }}" type="text" class="form-control @error('phone') is-invalid @enderror"
                                   name="phone" placeholder="Phone number">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input value="{{ old('date_of_birth') }}" type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                   name="date_of_birth">
                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="employee_id" class="form-label">Employee ID</label>
                            <input value="{{ old('employee_id') }}" type="text" class="form-control @error('employee_id') is-invalid @enderror"
                                   name="employee_id" placeholder="Employee ID">
                            @error('employee_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Employment Information -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="text-primary mb-3">
                            <i class="cil-briefcase me-2"></i>Employment Information
                        </h6>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="branch_id" class="form-label">Branch</label>
                            <select name="branch_id" class="form-select @error('branch_id') is-invalid @enderror">
                                <option value="">Select Branch</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('branch_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="department_id" class="form-label">Department</label>
                            <select name="department_id" class="form-select @error('department_id') is-invalid @enderror">
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="job_title_id" class="form-label">Job Title</label>
                            <select name="job_title_id" class="form-select @error('job_title_id') is-invalid @enderror">
                                <option value="">Select Job Title</option>
                                @foreach($jobTitles as $jobTitle)
                                    <option value="{{ $jobTitle->id }}" {{ old('job_title_id') == $jobTitle->id ? 'selected' : '' }}>
                                        {{ $jobTitle->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('job_title_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="employment_status_id" class="form-label">Employment Status</label>
                            <select name="employment_status_id" class="form-select @error('employment_status_id') is-invalid @enderror">
                                <option value="">Select Employment Status</option>
                                @foreach($employmentStatuses as $status)
                                    <option value="{{ $status->id }}" {{ old('employment_status_id') == $status->id ? 'selected' : '' }}>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('employment_status_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="hire_date" class="form-label">Hire Date</label>
                            <input value="{{ old('hire_date') }}" type="date" class="form-control @error('hire_date') is-invalid @enderror"
                                   name="hire_date">
                            @error('hire_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="position_level_id" class="form-label">Position Level</label>
                            <select name="position_level_id" class="form-select @error('position_level_id') is-invalid @enderror">
                                <option value="">Select Position Level</option>
                                @foreach($positionLevels as $level)
                                    <option value="{{ $level->id }}" {{ old('position_level_id') == $level->id ? 'selected' : '' }}>
                                        {{ $level->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('position_level_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Salary Information -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="text-primary mb-3">
                            <i class="cil-money me-2"></i>Salary Information
                        </h6>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="basic_salary" class="form-label">Basic Salary</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input value="{{ old('basic_salary') }}" type="number" class="form-control @error('basic_salary') is-invalid @enderror"
                                       name="basic_salary" placeholder="0">
                            </div>
                            @error('basic_salary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="allowance" class="form-label">Allowance</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input value="{{ old('allowance') }}" type="number" class="form-control @error('allowance') is-invalid @enderror"
                                       name="allowance" placeholder="0">
                            </div>
                            @error('allowance')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="bpjs_kesehatan" class="form-label">BPJS Kesehatan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input value="{{ old('bpjs_kesehatan') }}" type="number" class="form-control @error('bpjs_kesehatan') is-invalid @enderror"
                                       name="bpjs_kesehatan" placeholder="0">
                            </div>
                            @error('bpjs_kesehatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="bpjs_tenaga_kerja" class="form-label">BPJS Tenaga Kerja</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input value="{{ old('bpjs_tenaga_kerja') }}" type="number" class="form-control @error('bpjs_tenaga_kerja') is-invalid @enderror"
                                       name="bpjs_tenaga_kerja" placeholder="0">
                            </div>
                            @error('bpjs_tenaga_kerja')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- BPJS Numbers -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="text-primary mb-3">
                            <i class="cil-credit-card me-2"></i>BPJS Information
                        </h6>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="bpjs_kesehatan_number" class="form-label">BPJS Kesehatan Number</label>
                            <input value="{{ old('bpjs_kesehatan_number') }}" type="text" class="form-control @error('bpjs_kesehatan_number') is-invalid @enderror"
                                   name="bpjs_kesehatan_number" placeholder="BPJS Kesehatan Number">
                            @error('bpjs_kesehatan_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="bpjs_tenaga_kerja_number" class="form-label">BPJS Tenaga Kerja Number</label>
                            <input value="{{ old('bpjs_tenaga_kerja_number') }}" type="text" class="form-control @error('bpjs_tenaga_kerja_number') is-invalid @enderror"
                                   name="bpjs_tenaga_kerja_number" placeholder="BPJS Tenaga Kerja Number">
                            @error('bpjs_tenaga_kerja_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Address Information -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="text-primary mb-3">
                            <i class="cil-home me-2"></i>Address Information
                        </h6>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3"
                                      placeholder="Full address">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input value="{{ old('city') }}" type="text" class="form-control @error('city') is-invalid @enderror"
                                   name="city" placeholder="City">
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="postal_code" class="form-label">Postal Code</label>
                            <input value="{{ old('postal_code') }}" type="text" class="form-control @error('postal_code') is-invalid @enderror"
                                   name="postal_code" placeholder="Postal Code">
                            @error('postal_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Photo Upload -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="text-primary mb-3">
                            <i class="cil-camera me-2"></i>Profile Photo
                        </h6>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="photo" class="form-label">Upload Photo</label>
                            <input type="file" name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror"
                                   accept="image/*">
                            <div class="form-text">Accepted formats: JPG, PNG, GIF. Max size: 2MB</div>
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="photo-preview" class="d-none">
                            <img id="photo-preview-img" src="" alt="Photo Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                        </div>
                    </div>
                </div>

                <!-- Role Assignment -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="text-primary mb-3">
                            <i class="cil-lock-locked me-2"></i>Role & Permissions
                        </h6>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                            <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                                <option value="">Select Role</option>
                                @foreach($roles ?? [] as $role)
                                    <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary-gradient">
                        <i class="cil-user-plus me-1"></i> Create Employee
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Photo preview
    $('#photo').on('change', function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#photo-preview-img').attr('src', e.target.result);
                $('#photo-preview').removeClass('d-none');
            }
            reader.readAsDataURL(file);
        } else {
            $('#photo-preview').addClass('d-none');
        }
    });

    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endpush
