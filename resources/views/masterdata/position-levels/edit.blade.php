@extends('layouts.app')

@section('title')
Edit Position Level - {{ $positionLevel->name }}
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">
                        <i class="cil-layers me-2"></i>Edit Position Level
                    </h5>
                    <p class="mb-0 opacity-75">Update position level information</p>
                </div>
                <a href="{{ route('position-levels.index') }}" class="btn btn-secondary">
                    <i class="cil-arrow-left me-1"></i> Back to Position Levels
                </a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('position-levels.update', $positionLevel) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="name" class="form-label">Position Level Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $positionLevel->name) }}" placeholder="e.g., Junior, Senior, Manager" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="level_order" class="form-label">Level Order <span class="text-danger">*</span></label>
                            <input type="number" name="level_order" id="level_order" class="form-control @error('level_order') is-invalid @enderror"
                                   value="{{ old('level_order', $positionLevel->level_order) }}" min="1" placeholder="1" required>
                            <div class="form-text">Lower numbers = higher positions</div>
                            @error('level_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                              rows="3" placeholder="Describe this position level and its responsibilities">{{ old('description', $positionLevel->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input"
                               value="1" {{ old('is_active', $positionLevel->is_active) ? 'checked' : '' }}>
                        <label for="is_active" class="form-check-label">
                            Active
                        </label>
                    </div>
                    <div class="form-text">Inactive position levels won't be available for selection</div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('position-levels.index') }}" class="btn btn-secondary">
                        <i class="cil-x me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="cil-save me-1"></i> Update Position Level
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection