@extends('layouts.app')

@section('title')
Bank Details - {{ $bank->name }}
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-header bg-info text-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">
                        <i class="cil-bank me-2"></i>Bank Details
                    </h5>
                    <p class="mb-0 opacity-75">{{ $bank->name }}</p>
                </div>
                <div>
                    <a href="{{ route('banks.edit', $bank) }}" class="btn btn-light me-2">
                        <i class="cil-pencil me-1"></i> Edit
                    </a>
                    <a href="{{ route('banks.index') }}" class="btn btn-light">
                        <i class="cil-arrow-left me-1"></i> Back to Banks
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <td class="fw-bold" width="200">Bank Name:</td>
                            <td>{{ $bank->name }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Bank Code:</td>
                            <td>
                                @if($bank->code)
                                    <span class="badge bg-primary">{{ $bank->code }}</span>
                                @else
                                    <span class="text-muted">Not set</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Status:</td>
                            <td>
                                @if($bank->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Description:</td>
                            <td>
                                @if($bank->description)
                                    {{ $bank->description }}
                                @else
                                    <span class="text-muted">No description provided</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Created:</td>
                            <td>{{ $bank->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Last Updated:</td>
                            <td>{{ $bank->updated_at->format('d M Y, H:i') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0">
                                <i class="cil-info me-2"></i>Quick Actions
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('banks.edit', $bank) }}" class="btn btn-outline-primary">
                                    <i class="cil-pencil me-2"></i>Edit Bank
                                </a>
                                <a href="{{ route('banks.index') }}" class="btn btn-outline-secondary">
                                    <i class="cil-list me-2"></i>View All Banks
                                </a>
                                <a href="{{ route('banks.create') }}" class="btn btn-outline-success">
                                    <i class="cil-plus me-2"></i>Add New Bank
                                </a>
                            </div>
                        </div>
                    </div>

                    @if($bank->trashed())
                        <div class="alert alert-warning mt-3">
                            <i class="cil-warning me-2"></i>
                            <strong>This bank is deleted!</strong><br>
                            It will be permanently removed after 30 days.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection