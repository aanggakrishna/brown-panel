@extends('layouts.app')

@section('title')
{{ $user->name }} - Profile
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">{{ $user->name }}</h5>
                    <h6 class="card-subtitle text-muted">Employee Profile Details</h6>
                </div>
                <div>
                    <a href="{{ route('user-documents.index', $user) }}" class="btn btn-success-gradient me-2">
                        <i class="cil-folder me-1"></i> Documents
                    </a>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning-gradient me-2">
                        <i class="cil-pencil me-1"></i> Edit
                    </a>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <i class="cil-arrow-left me-1"></i> Back to Users
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
        <div class="card-body">
            <div class="row">
                <!-- Left Column: Profile Photo -->
                <div class="col-md-3 mb-4">
                    <div class="card border info-card">
                        <div class="card-body text-center">
                            <div class="profile-photo-wrapper">
                                @if($user->photo_path)
                                    <img src="{{ asset('storage/' . $user->photo_path) }}" alt="Profile Photo"
                                         class="img-fluid rounded-circle mb-3"
                                         style="width: 200px; height: 200px; object-fit: cover; border: 4px solid #f8f9fa;">
                                @else
                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                         style="width: 200px; height: 200px; border: 4px solid #f8f9fa;">
                                        <i class="cil-user" style="font-size: 5rem; color: #6c757d;"></i>
                                    </div>
                                @endif
                            </div>
                            <h5 class="mb-1">{{ $user->name }}</h5>
                            <p class="text-muted mb-2">{{ $user->jobTitle?->name ?? 'No Job Title' }}</p>
                            <p class="text-muted small mb-2">
                                <i class="cil-envelope me-1"></i>{{ $user->email }}
                            </p>
                            @if($user->roles->isNotEmpty())
                                @foreach($user->roles as $role)
                                    <span class="badge bg-primary-gradient me-1">{{ $role->name }}</span>
                                @endforeach
                            @else
                                <span class="badge bg-secondary">No Role</span>
                            @endif
                        </div>
                    </div>

                    <!-- Quick Stats Card -->
                    <div class="card border info-card mt-3">
                        <div class="card-header bg-white">
                            <h6 class="mb-0"><i class="cil-speedometer me-2 text-primary"></i>Quick Stats</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                                    <span class="text-muted"><i class="cil-folder me-1"></i>Documents</span>
                                    <span class="badge bg-info">{{ $user->documents->count() }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                                    <span class="text-muted"><i class="cil-check-circle me-1"></i>Verified</span>
                                    <span class="badge bg-success">{{ $user->documents->where('is_verified', true)->count() }}</span>
                                </div>
                                @if($user->hire_date)
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted"><i class="cil-calendar me-1"></i>Working Days</span>
                                    <span class="badge bg-primary">{{ $user->hire_date->diffInDays(now()) }} days</span>
                                </div>
                                @endif
                            </div>
                            <a href="{{ route('user-documents.index', $user) }}" class="btn btn-outline-primary btn-sm w-100">
                                <i class="cil-folder-open me-1"></i> Manage Documents
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Details -->
                <div class="col-md-9">
                    <!-- Basic Information -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-primary mb-3 pb-2 border-bottom">
                                <i class="cil-user me-2"></i>Basic Information
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">Full Name</label>
                                <div class="fw-bold">{{ $user->name }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">Email</label>
                                <div class="fw-bold">{{ $user->email }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">Username</label>
                                <div class="fw-bold">{{ $user->username ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">Phone</label>
                                <div class="fw-bold">{{ $user->phone ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">Date of Birth</label>
                                <div class="fw-bold">
                                    @if($user->date_of_birth)
                                        {{ $user->date_of_birth->format('d F Y') }}
                                        <span class="text-muted">({{ $user->date_of_birth->age }} years old)</span>
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">Employee ID</label>
                                <div class="fw-bold">{{ $user->employee_id ?? '-' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Employment Information -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-primary mb-3 pb-2 border-bottom">
                                <i class="cil-briefcase me-2"></i>Employment Information
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">Branch</label>
                                <div class="fw-bold">{{ $user->branch?->name ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">Department</label>
                                <div class="fw-bold">{{ $user->department?->name ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">Job Title</label>
                                <div class="fw-bold">{{ $user->jobTitle?->name ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">Employment Status</label>
                                <div class="fw-bold">{{ $user->employmentStatus?->name ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">Hire Date</label>
                                <div class="fw-bold">
                                    @if($user->hire_date)
                                        {{ $user->hire_date->format('d F Y') }}
                                        <span class="text-muted">({{ $user->hire_date->diffForHumans() }})</span>
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">Position Level</label>
                                <div class="fw-bold">{{ $user->positionLevel?->name ?? '-' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Salary Information -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-primary mb-3 pb-2 border-bottom">
                                <i class="cil-money me-2"></i>Salary Information
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">Basic Salary</label>
                                <div class="fw-bold">
                                    @if($user->basic_salary)
                                        Rp {{ number_format($user->basic_salary, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">Allowance</label>
                                <div class="fw-bold">
                                    @if($user->allowance)
                                        Rp {{ number_format($user->allowance, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">BPJS Kesehatan</label>
                                <div class="fw-bold">
                                    @if($user->bpjs_kesehatan)
                                        Rp {{ number_format($user->bpjs_kesehatan, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">BPJS Tenaga Kerja</label>
                                <div class="fw-bold">
                                    @if($user->bpjs_tenaga_kerja)
                                        Rp {{ number_format($user->bpjs_tenaga_kerja, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if($user->basic_salary || $user->allowance)
                        <div class="col-12">
                            <div class="alert alert-success mb-0">
                                <strong>Total Salary:</strong>
                                Rp {{ number_format(($user->basic_salary ?? 0) + ($user->allowance ?? 0), 0, ',', '.') }}
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- BPJS Information -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-primary mb-3 pb-2 border-bottom">
                                <i class="cil-credit-card me-2"></i>BPJS Information
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">BPJS Kesehatan Number</label>
                                <div class="fw-bold">{{ $user->bpjs_kesehatan_number ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">BPJS Tenaga Kerja Number</label>
                                <div class="fw-bold">{{ $user->bpjs_tenaga_kerja_number ?? '-' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Address Information -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-primary mb-3 pb-2 border-bottom">
                                <i class="cil-home me-2"></i>Address Information
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">Address</label>
                                <div class="fw-bold">{{ $user->address ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">City</label>
                                <div class="fw-bold">{{ $user->city ?? '-' }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small">Postal Code</label>
                                <div class="fw-bold">{{ $user->postal_code ?? '-' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Role & Permissions -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-primary mb-3 pb-2 border-bottom">
                                <i class="cil-lock-locked me-2"></i>Role & Permissions
                            </h6>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="text-muted small">Assigned Roles</label>
                                <div>
                                    @if($user->roles->isNotEmpty())
                                        @foreach($user->roles as $role)
                                            <span class="badge bg-primary-gradient me-1">{{ $role->name }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">No role assigned</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Information -->
                    <div class="row">
                        <div class="col-12">
                            <h6 class="text-primary mb-3 pb-2 border-bottom">
                                <i class="cil-info me-2"></i>Account Information
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">Account Created</label>
                                <div class="fw-bold">{{ $user->created_at->format('d F Y, H:i') }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small">Last Updated</label>
                                <div class="fw-bold">{{ $user->updated_at->format('d F Y, H:i') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .info-card {
        transition: all 0.3s ease;
    }
    .info-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .profile-photo-wrapper {
        position: relative;
        display: inline-block;
    }
    .profile-photo-wrapper::after {
        content: '';
        position: absolute;
        bottom: 10px;
        right: 10px;
        width: 20px;
        height: 20px;
        background: #28a745;
        border: 3px solid white;
        border-radius: 50%;
    }
    .section-title {
        position: relative;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(to right, #007bff, #0056b3);
        border-radius: 2px;
    }
    .info-label {
        font-size: 0.875rem;
        color: #6c757d;
        margin-bottom: 0.25rem;
    }
    .info-value {
        font-weight: 600;
        color: #2c3e50;
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Add animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    document.querySelectorAll('.row.mb-4').forEach(element => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        element.style.transition = 'all 0.5s ease';
        observer.observe(element);
    });
});
</script>
@endpush
