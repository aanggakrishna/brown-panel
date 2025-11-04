@extends('layouts.app')

@section('title')
Create Shift
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-header bg-secondary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">
                        <i class="cil-clock me-2"></i>Create Shift
                    </h5>
                    <p class="mb-0 opacity-75">Add a new work shift to the system</p>
                </div>
                <a href="{{ route('shifts.index') }}" class="btn btn-light btn-sm">
                    <i class="cil-arrow-left me-1"></i> Back to Shifts
                </a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('shifts.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Shift Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" placeholder="e.g., Morning Shift, Night Shift, Weekend Shift" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="start_time" class="form-label">Start Time <span class="text-danger">*</span></label>
                            <input type="time" name="start_time" id="start_time" class="form-control @error('start_time') is-invalid @enderror"
                                   value="{{ old('start_time') }}" required>
                            @error('start_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="end_time" class="form-label">End Time <span class="text-danger">*</span></label>
                            <input type="time" name="end_time" id="end_time" class="form-control @error('end_time') is-invalid @enderror"
                                   value="{{ old('end_time') }}" required>
                            @error('end_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="duration_hours" class="form-label">Duration (Hours) <span class="text-danger">*</span></label>
                            <input type="number" name="duration_hours" id="duration_hours" class="form-control @error('duration_hours') is-invalid @enderror"
                                   value="{{ old('duration_hours', 8) }}" min="1" max="24" placeholder="8" required>
                            @error('duration_hours')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                              rows="3" placeholder="Describe this shift schedule and any special conditions">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input"
                               value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label for="is_active" class="form-check-label">
                            Active
                        </label>
                    </div>
                    <div class="form-text">Inactive shifts won't be available for selection</div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('shifts.index') }}" class="btn btn-secondary">
                        <i class="cil-x me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-secondary">
                        <i class="cil-save me-1"></i> Create Shift
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
