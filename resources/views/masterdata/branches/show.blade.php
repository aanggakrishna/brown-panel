@extends('layouts.app')

@section('title')
Branch Details - {{ $branch->name }}
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">
                        <i class="cil-building me-2"></i>Branch Details
                    </h5>
                    <p class="mb-0 opacity-75">{{ $branch->name }}</p>
                </div>
                <div class="btn-group">
                    <a href="{{ route('branches.edit', $branch) }}" class="btn btn-light btn-sm">
                        <i class="cil-pencil me-1"></i> Edit
                    </a>
                    <a href="{{ route('branches.index') }}" class="btn btn-secondary btn-sm">
                        <i class="cil-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
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
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td class="fw-bold" style="width: 150px;">Branch Name:</td>
                                                <td>{{ $branch->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Branch Code:</td>
                                                <td>
                                                    @if($branch->code)
                                                        <span class="badge bg-secondary">{{ $branch->code }}</span>
                                                    @else
                                                        <span class="text-muted">Not set</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Branch Type:</td>
                                                <td>
                                                    <span class="badge bg-info">{{ $branch->branch_type_label }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Employee Count:</td>
                                                <td>
                                                    @if($branch->employee_count)
                                                        <span class="badge bg-success">{{ $branch->employee_count }} employees</span>
                                                    @else
                                                        <span class="text-muted">Not specified</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Status:</td>
                                                <td>
                                                    @if($branch->is_active)
                                                        <span class="badge bg-success">
                                                            <i class="cil-check me-1"></i>Active
                                                        </span>
                                                    @else
                                                        <span class="badge bg-danger">
                                                            <i class="cil-x me-1"></i>Inactive
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold">Description:</label>
                                        <div>
                                            @if($branch->description)
                                                {{ $branch->description }}
                                            @else
                                                <span class="text-muted">No description provided</span>
                                            @endif
                                        </div>
                                    </div>
                                    @if($branch->establishment_date)
                                        <div class="mb-3">
                                            <label class="fw-bold">Established:</label>
                                            <div>{{ $branch->establishment_date->format('M d, Y') }}</div>
                                        </div>
                                    @endif
                                    @if($branch->notes)
                                        <div class="mb-3">
                                            <label class="fw-bold">Notes:</label>
                                            <div>{{ $branch->notes }}</div>
                                        </div>
                                    @endif
                                </div>
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
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="fw-bold">Full Address:</label>
                                        <div>{{ $branch->formatted_address }}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    @if($branch->latitude && $branch->longitude)
                                        <div class="mb-3">
                                            <label class="fw-bold">Coordinates:</label>
                                            <div>
                                                <small class="text-muted">
                                                    Lat: {{ $branch->latitude }}<br>
                                                    Lng: {{ $branch->longitude }}
                                                </small>
                                            </div>
                                        </div>
                                    @endif
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
                            @if($branch->formatted_contact)
                                <div>{{ $branch->formatted_contact }}</div>
                            @else
                                <span class="text-muted">No contact information provided</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Manager Information -->
            @if($branch->manager_name || $branch->manager_phone || $branch->manager_email)
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
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td class="fw-bold" style="width: 120px;">Name:</td>
                                                <td>{{ $branch->manager_name ?: 'Not specified' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Phone:</td>
                                                <td>{{ $branch->manager_phone ?: 'Not specified' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Email:</td>
                                                <td>{{ $branch->manager_email ?: 'Not specified' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Contact Person -->
            @if($branch->contact_person_name || $branch->contact_person_phone || $branch->contact_person_email)
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
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td class="fw-bold" style="width: 120px;">Name:</td>
                                                <td>{{ $branch->contact_person_name ?: 'Not specified' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Phone:</td>
                                                <td>{{ $branch->contact_person_phone ?: 'Not specified' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Email:</td>
                                                <td>{{ $branch->contact_person_email ?: 'Not specified' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Operating Hours -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-primary">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">
                                <i class="cil-clock me-2 text-primary"></i>Operating Hours
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold">Operating Hours:</label>
                                        <div>{{ $branch->operating_hours_display }}</div>
                                    </div>
                                </div>
                                @if($branch->opening_time && $branch->closing_time)
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold">Time Range:</label>
                                        <div>
                                            <span class="badge bg-primary">{{ $branch->opening_time->format('H:i') }} - {{ $branch->closing_time->format('H:i') }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Departments -->
            @if($branch->departments->count() > 0)
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-dark">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">
                                <i class="cil-sitemap me-2 text-dark"></i>Departments ({{ $branch->departments->count() }})
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($branch->departments as $department)
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $department->name }}</h6>
                                                @if($department->code)
                                                    <p class="card-text">
                                                        <small class="text-muted">Code: {{ $department->code }}</small>
                                                    </p>
                                                @endif
                                                <div class="mt-2">
                                                    @if($department->is_active)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-secondary">Inactive</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if($branch->trashed())
                <div class="alert alert-warning mt-3">
                    <i class="cil-warning me-2"></i>
                    This branch has been deleted but can be restored.
                    <a href="{{ route('branches.restore', $branch) }}" class="alert-link ms-2">
                        <i class="cil-reload me-1"></i>Restore Branch
                    </a>
                </div>
            @endif
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Branch ID: {{ $branch->id }}
                </small>
                <div class="btn-group btn-group-sm">
                    @if(!$branch->trashed())
                        <form action="{{ route('branches.destroy', $branch) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete this branch? This will also affect all related departments.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="cil-trash me-1"></i> Delete
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
