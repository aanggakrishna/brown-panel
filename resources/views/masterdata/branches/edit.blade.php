@extends('layouts.app')

@section('title')
Edit Branch - {{ $branch->name }}
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">
                        <i class="cil-building me-2"></i>Edit Branch
                    </h5>
                    <p class="mb-0 opacity-75">Update branch information for {{ $branch->name }}</p>
                </div>
                <a href="{{ route('branches.index') }}" class="btn btn-light">
                    <i class="cil-arrow-left me-1"></i> Back to Branches
                </a>
            </div>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="cil-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-coreui-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('branches.update', $branch) }}" method="POST">
                @csrf
                @method('PATCH')

                <!-- Basic Information -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-primary">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="cil-info me-2 text-primary"></i>Basic Information
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Branch Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                                   value="{{ old('name', $branch->name) }}" placeholder="e.g., Jakarta Head Office" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="code" class="form-label">Branch Code</label>
                                            <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror"
                                                   value="{{ old('code', $branch->code) }}" placeholder="e.g., HO-JKT" maxlength="50">
                                            <div class="form-text">Unique code for this branch (optional)</div>
                                            @error('code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="branch_type" class="form-label">Branch Type</label>
                                            <select name="branch_type" id="branch_type" class="form-select @error('branch_type') is-invalid @enderror">
                                                <option value="">Select Branch Type</option>
                                                <option value="head_office" {{ old('branch_type', $branch->branch_type) == 'head_office' ? 'selected' : '' }}>Head Office</option>
                                                <option value="branch" {{ old('branch_type', $branch->branch_type) == 'branch' ? 'selected' : '' }}>Branch Office</option>
                                                <option value="warehouse" {{ old('branch_type', $branch->branch_type) == 'warehouse' ? 'selected' : '' }}>Warehouse</option>
                                                <option value="store" {{ old('branch_type', $branch->branch_type) == 'store' ? 'selected' : '' }}>Store/Outlet</option>
                                                <option value="factory" {{ old('branch_type', $branch->branch_type) == 'factory' ? 'selected' : '' }}>Factory</option>
                                                <option value="workshop" {{ old('branch_type', $branch->branch_type) == 'workshop' ? 'selected' : '' }}>Workshop</option>
                                                <option value="other" {{ old('branch_type', $branch->branch_type) == 'other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                            @error('branch_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="employee_count" class="form-label">Employee Count</label>
                                            <input type="number" name="employee_count" id="employee_count" class="form-control @error('employee_count') is-invalid @enderror"
                                                   value="{{ old('employee_count', $branch->employee_count) }}" min="0">
                                            <div class="form-text">Number of employees at this branch</div>
                                            @error('employee_count')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                              rows="3" placeholder="Brief description about this branch">{{ old('description', $branch->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Address Information -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-info">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="cil-location-pin me-2 text-info"></i>Address Information
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Street Address <span class="text-danger">*</span></label>
                                    <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                                              rows="3" placeholder="Full street address" required>{{ old('address', $branch->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                            <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror"
                                                   value="{{ old('city', $branch->city) }}" placeholder="e.g., Jakarta" required>
                                            @error('city')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="province" class="form-label">Province</label>
                                            <input type="text" name="province" id="province" class="form-control @error('province') is-invalid @enderror"
                                                   value="{{ old('province', $branch->province) }}" placeholder="e.g., DKI Jakarta">
                                            @error('province')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="postal_code" class="form-label">Postal Code</label>
                                            <input type="text" name="postal_code" id="postal_code" class="form-control @error('postal_code') is-invalid @enderror"
                                                   value="{{ old('postal_code', $branch->postal_code) }}" placeholder="e.g., 10230" maxlength="10">
                                            @error('postal_code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="latitude" class="form-label">Latitude</label>
                                            <input type="number" name="latitude" id="latitude" class="form-control @error('latitude') is-invalid @enderror"
                                                   value="{{ old('latitude', $branch->latitude) }}" step="any" min="-90" max="90"
                                                   placeholder="e.g., -6.2088">
                                            <div class="form-text">GPS coordinates for mapping</div>
                                            @error('latitude')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="longitude" class="form-label">Longitude</label>
                                            <input type="number" name="longitude" id="longitude" class="form-control @error('longitude') is-invalid @enderror"
                                                   value="{{ old('longitude', $branch->longitude) }}" step="any" min="-180" max="180"
                                                   placeholder="e.g., 106.8456">
                                            <div class="form-text">GPS coordinates for mapping</div>
                                            @error('longitude')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-success">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="cil-phone me-2 text-success"></i>Contact Information
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
                                                   value="{{ old('phone', $branch->phone) }}" placeholder="e.g., +62 21 1234 5678">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="fax" class="form-label">Fax Number</label>
                                            <input type="text" name="fax" id="fax" class="form-control @error('fax') is-invalid @enderror"
                                                   value="{{ old('fax', $branch->fax) }}" placeholder="e.g., +62 21 1234 5679">
                                            @error('fax')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                                   value="{{ old('email', $branch->email) }}" placeholder="branch@company.com">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="website" class="form-label">Website</label>
                                            <input type="url" name="website" id="website" class="form-control @error('website') is-invalid @enderror"
                                                   value="{{ old('website', $branch->website) }}" placeholder="https://branch.company.com">
                                            @error('website')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Manager Information -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-warning">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="cil-user me-2 text-warning"></i>Manager Information
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="manager_name" class="form-label">Manager Name</label>
                                            <input type="text" name="manager_name" id="manager_name" class="form-control @error('manager_name') is-invalid @enderror"
                                                   value="{{ old('manager_name', $branch->manager_name) }}" placeholder="Branch Manager's full name">
                                            @error('manager_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="manager_phone" class="form-label">Manager Phone</label>
                                            <input type="text" name="manager_phone" id="manager_phone" class="form-control @error('manager_phone') is-invalid @enderror"
                                                   value="{{ old('manager_phone', $branch->manager_phone) }}" placeholder="Manager's phone number">
                                            @error('manager_phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="manager_email" class="form-label">Manager Email</label>
                                    <input type="email" name="manager_email" id="manager_email" class="form-control @error('manager_email') is-invalid @enderror"
                                           value="{{ old('manager_email', $branch->manager_email) }}" placeholder="manager@company.com">
                                    @error('manager_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Person -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-secondary">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="cil-people me-2 text-secondary"></i>Contact Person
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="contact_person_name" class="form-label">Contact Person Name</label>
                                            <input type="text" name="contact_person_name" id="contact_person_name" class="form-control @error('contact_person_name') is-invalid @enderror"
                                                   value="{{ old('contact_person_name', $branch->contact_person_name) }}" placeholder="Primary contact person's name">
                                            @error('contact_person_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="contact_person_phone" class="form-label">Contact Person Phone</label>
                                            <input type="text" name="contact_person_phone" id="contact_person_phone" class="form-control @error('contact_person_phone') is-invalid @enderror"
                                                   value="{{ old('contact_person_phone', $branch->contact_person_phone) }}" placeholder="Contact person's phone number">
                                            @error('contact_person_phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="contact_person_email" class="form-label">Contact Person Email</label>
                                    <input type="email" name="contact_person_email" id="contact_person_email" class="form-control @error('contact_person_email') is-invalid @enderror"
                                           value="{{ old('contact_person_email', $branch->contact_person_email) }}" placeholder="contact@company.com">
                                    @error('contact_person_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Operating Hours & Additional Info -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-primary">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="cil-clock me-2 text-primary"></i>Operating Hours & Additional Information
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="opening_time" class="form-label">Opening Time</label>
                                            <input type="time" name="opening_time" id="opening_time" class="form-control @error('opening_time') is-invalid @enderror"
                                                   value="{{ old('opening_time', $branch->opening_time ? $branch->opening_time->format('H:i') : '') }}">
                                            @error('opening_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="closing_time" class="form-label">Closing Time</label>
                                            <input type="time" name="closing_time" id="closing_time" class="form-control @error('closing_time') is-invalid @enderror"
                                                   value="{{ old('closing_time', $branch->closing_time ? $branch->closing_time->format('H:i') : '') }}">
                                            @error('closing_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="operating_hours" class="form-label">Operating Hours Description</label>
                                    <textarea name="operating_hours" id="operating_hours" class="form-control @error('operating_hours') is-invalid @enderror"
                                              rows="2" placeholder="e.g., Monday - Friday: 08:00 - 17:00, Saturday: 08:00 - 12:00">{{ old('operating_hours', $branch->operating_hours) }}</textarea>
                                    <div class="form-text">Detailed operating hours description (optional if time fields are filled)</div>
                                    @error('operating_hours')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="establishment_date" class="form-label">Establishment Date</label>
                                            <input type="date" name="establishment_date" id="establishment_date" class="form-control @error('establishment_date') is-invalid @enderror"
                                                   value="{{ old('establishment_date', $branch->establishment_date ? $branch->establishment_date->format('Y-m-d') : '') }}">
                                            @error('establishment_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="form-check mt-4">
                                                <input type="checkbox" name="is_active" id="is_active" class="form-check-input"
                                                       value="1" {{ old('is_active', $branch->is_active) ? 'checked' : '' }}>
                                                <label for="is_active" class="form-check-label">
                                                    Branch is active
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="notes" class="form-label">Additional Notes</label>
                                    <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror"
                                              rows="3" placeholder="Any additional notes about this branch">{{ old('notes', $branch->notes) }}</textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('branches.index') }}" class="btn btn-secondary">
                                <i class="cil-x me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="cil-save me-1"></i> Update Branch
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Auto-format phone numbers
    $('#phone, #fax, #manager_phone, #contact_person_phone').on('input', function() {
        var value = $(this).val().replace(/\D/g, '');
        if (value.length > 0) {
            if (value.startsWith('62')) {
                // Indonesian format
                $(this).val(value.replace(/(\d{2})(\d{3})(\d{4})(\d{4})/, '+$1 $2-$3-$4'));
            } else if (value.startsWith('0')) {
                // Local format
                $(this).val(value.replace(/(\d{3})(\d{4})(\d{4})/, '$1-$2-$3'));
            }
        }
    });

    // Validate closing time is after opening time
    $('#opening_time, #closing_time').on('change', function() {
        var openingTime = $('#opening_time').val();
        var closingTime = $('#closing_time').val();

        if (openingTime && closingTime) {
            if (openingTime >= closingTime) {
                $('#closing_time')[0].setCustomValidity('Closing time must be after opening time');
            } else {
                $('#closing_time')[0].setCustomValidity('');
            }
        }
    });
});
</script>
@endpush
