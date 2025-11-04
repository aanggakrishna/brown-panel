@extends('layouts.app')

@section('title')
Edit Job Title - {{ $jobTitle->name }}
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">
                        <i class="cil-briefcase me-2"></i>Edit Job Title
                    </h5>
                    <p class="mb-0 opacity-75">Update job title information</p>
                </div>
                <a href="{{ route('job-titles.index') }}" class="btn btn-secondary">
                    <i class="cil-arrow-left me-1"></i> Back to Job Titles
                </a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('job-titles.update', $jobTitle) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="name" class="form-label">Job Title Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $jobTitle->name) }}" placeholder="e.g., Software Engineer" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="department_id" class="form-label">Department <span class="text-danger">*</span></label>
                            <select name="department_id" id="department_id" class="form-select @error('department_id') is-invalid @enderror" required>
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('department_id', $jobTitle->department_id) == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                        @if($department->code)
                                            ({{ $department->code }})
                                        @endif
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
                            <label for="position_level_id" class="form-label">Position Level <span class="text-danger">*</span></label>
                            <select name="position_level_id" id="position_level_id" class="form-select @error('position_level_id') is-invalid @enderror" required>
                                <option value="">Select Position Level</option>
                                @foreach($positionLevels as $level)
                                    <option value="{{ $level->id }}" {{ old('position_level_id', $jobTitle->position_level_id) == $level->id ? 'selected' : '' }}>
                                        {{ $level->name }}
                                        @if($level->code)
                                            ({{ $level->code }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('position_level_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                              rows="3" placeholder="Describe the responsibilities and requirements for this job title">{{ old('description', $jobTitle->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input"
                               value="1" {{ old('is_active', $jobTitle->is_active) ? 'checked' : '' }}>
                        <label for="is_active" class="form-check-label">
                            Active
                        </label>
                    </div>
                    <div class="form-text">Inactive job titles won't be available for selection</div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('job-titles.index') }}" class="btn btn-secondary">
                        <i class="cil-x me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="cil-save me-1"></i> Update Job Title
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection