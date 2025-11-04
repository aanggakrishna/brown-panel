@extends('layouts.app')

@section('title')
Edit Department - {{ $department->name }}
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">
                        <i class="cil-sitemap me-2"></i>Edit Department
                    </h5>
                    <p class="mb-0 opacity-75">Update department information</p>
                </div>
                <a href="{{ route('departments.index') }}" class="btn btn-secondary">
                    <i class="cil-arrow-left me-1"></i> Back to Departments
                </a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('departments.update', $department) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="name" class="form-label">Department Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $department->name) }}" placeholder="e.g., Human Resources" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="code" class="form-label">Department Code</label>
                            <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror"
                                   value="{{ old('code', $department->code) }}" placeholder="e.g., HR" maxlength="10">
                            <div class="form-text">Optional unique identifier</div>
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="branch_id" class="form-label">Branch <span class="text-danger">*</span></label>
                    <select name="branch_id" id="branch_id" class="form-select @error('branch_id') is-invalid @enderror" required>
                        <option value="">Select Branch</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ old('branch_id', $department->branch_id) == $branch->id ? 'selected' : '' }}>
                                {{ $branch->name }}
                                @if($branch->code)
                                    ({{ $branch->code }})
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @error('branch_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                              rows="3" placeholder="Additional information about this department">{{ old('description', $department->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input"
                               value="1" {{ old('is_active', $department->is_active) ? 'checked' : '' }}>
                        <label for="is_active" class="form-check-label">
                            Active
                        </label>
                    </div>
                    <div class="form-text">Inactive departments won't be available for selection</div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('departments.index') }}" class="btn btn-secondary">
                        <i class="cil-x me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="cil-save me-1"></i> Update Department
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection