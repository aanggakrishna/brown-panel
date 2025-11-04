@extends('layouts.app')

@section('title')
Edit Employment Status - {{ $employmentStatus->name }}
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">
                        <i class="cil-user me-2"></i>Edit Employment Status
                    </h5>
                    <p class="mb-0 opacity-75">Update employment status information</p>
                </div>
                <a href="{{ route('employment-statuses.index') }}" class="btn btn-secondary">
                    <i class="cil-arrow-left me-1"></i> Back to Employment Statuses
                </a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('employment-statuses.update', $employmentStatus) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="name" class="form-label">Employment Status Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $employmentStatus->name) }}" placeholder="e.g., Permanent, Contract, Probation" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                              rows="3" placeholder="Describe this employment status and its implications">{{ old('description', $employmentStatus->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input"
                               value="1" {{ old('is_active', $employmentStatus->is_active) ? 'checked' : '' }}>
                        <label for="is_active" class="form-check-label">
                            Active
                        </label>
                    </div>
                    <div class="form-text">Inactive employment statuses won't be available for selection</div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('employment-statuses.index') }}" class="btn btn-secondary">
                        <i class="cil-x me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="cil-save me-1"></i> Update Employment Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection