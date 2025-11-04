@extends('layouts.app')

@section('title')
Edit Leave Type - {{ $leaveType->name }}
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">
                        <i class="cil-calendar me-2"></i>Edit Leave Type
                    </h5>
                    <p class="mb-0 opacity-75">Update leave type information</p>
                </div>
                <a href="{{ route('leave-types.index') }}" class="btn btn-secondary">
                    <i class="cil-arrow-left me-1"></i> Back to Leave Types
                </a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('leave-types.update', $leaveType) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="name" class="form-label">Leave Type Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $leaveType->name) }}" placeholder="e.g., Annual Leave, Sick Leave, Maternity Leave" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="max_days_per_year" class="form-label">Max Days Per Year <span class="text-danger">*</span></label>
                            <input type="number" name="max_days_per_year" id="max_days_per_year" class="form-control @error('max_days_per_year') is-invalid @enderror"
                                   value="{{ old('max_days_per_year', $leaveType->max_days_per_year) }}" min="0" placeholder="0" required>
                            <div class="form-text">0 = unlimited</div>
                            @error('max_days_per_year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                              rows="3" placeholder="Describe this leave type and its usage guidelines">{{ old('description', $leaveType->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="is_paid" id="is_paid" class="form-check-input"
                                       value="1" {{ old('is_paid', $leaveType->is_paid) ? 'checked' : '' }}>
                                <label for="is_paid" class="form-check-label">
                                    Paid Leave
                                </label>
                            </div>
                            <div class="form-text">Employees get paid during this leave</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="is_active" id="is_active" class="form-check-input"
                                       value="1" {{ old('is_active', $leaveType->is_active) ? 'checked' : '' }}>
                                <label for="is_active" class="form-check-label">
                                    Active
                                </label>
                            </div>
                            <div class="form-text">Inactive leave types won't be available for selection</div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('leave-types.index') }}" class="btn btn-secondary">
                        <i class="cil-x me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="cil-save me-1"></i> Update Leave Type
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
