@extends('layouts.app')

@section('title')
Add New Bank
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">
                        <i class="cil-bank me-2"></i>Add New Bank
                    </h5>
                    <p class="mb-0 opacity-75">Create a new bank record</p>
                </div>
                <a href="{{ route('banks.index') }}" class="btn btn-light">
                    <i class="cil-arrow-left me-1"></i> Back to Banks
                </a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('banks.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="name" class="form-label">Bank Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" placeholder="e.g., Bank Central Asia" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="code" class="form-label">Bank Code</label>
                            <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror"
                                   value="{{ old('code') }}" placeholder="e.g., BCA" maxlength="10">
                            <div class="form-text">Optional unique identifier</div>
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                              rows="3" placeholder="Additional information about this bank">{{ old('description') }}</textarea>
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
                    <div class="form-text">Inactive banks won't be available for selection</div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('banks.index') }}" class="btn btn-secondary">
                        <i class="cil-x me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="cil-save me-1"></i> Create Bank
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection