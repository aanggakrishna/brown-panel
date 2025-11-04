@extends('layouts.app')

@section('title')
Leave Type Details - {{ $leaveType->name }}
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-header bg-info text-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">
                        <i class="cil-calendar me-2"></i>Leave Type Details
                    </h5>
                    <p class="mb-0 opacity-75">{{ $leaveType->name }}</p>
                </div>
                <div class="btn-group">
                    <a href="{{ route('leave-types.edit', $leaveType) }}" class="btn btn-light btn-sm">
                        <i class="cil-pencil me-1"></i> Edit
                    </a>
                    <a href="{{ route('leave-types.index') }}" class="btn btn-secondary btn-sm">
                        <i class="cil-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="fw-bold" style="width: 200px;">Leave Type Name:</td>
                                <td>{{ $leaveType->name }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Max Days Per Year:</td>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $leaveType->max_days_per_year == 0 ? 'Unlimited' : $leaveType->max_days_per_year . ' days' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Payment Status:</td>
                                <td>
                                    @if($leaveType->is_paid)
                                        <span class="badge bg-success">
                                            <i class="cil-money me-1"></i>Paid Leave
                                        </span>
                                    @else
                                        <span class="badge bg-warning">
                                            <i class="cil-ban me-1"></i>Unpaid Leave
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Status:</td>
                                <td>
                                    @if($leaveType->is_active)
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
                            <tr>
                                <td class="fw-bold">Description:</td>
                                <td>
                                    @if($leaveType->description)
                                        {{ $leaveType->description }}
                                    @else
                                        <span class="text-muted">No description provided</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="cil-clock me-2"></i>Timestamps
                            </h6>
                        </div>
                        <div class="card-body">
                            <small>
                                <strong>Created:</strong><br>
                                {{ $leaveType->created_at->format('M d, Y H:i') }}<br><br>
                                <strong>Last Updated:</strong><br>
                                {{ $leaveType->updated_at->format('M d, Y H:i') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            @if($leaveType->trashed())
                <div class="alert alert-warning mt-3">
                    <i class="cil-warning me-2"></i>
                    This leave type has been deleted but can be restored.
                    <a href="{{ route('leave-types.restore', $leaveType) }}" class="alert-link ms-2">
                        <i class="cil-reload me-1"></i>Restore Leave Type
                    </a>
                </div>
            @endif
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Leave Type ID: {{ $leaveType->id }}
                </small>
                <div class="btn-group btn-group-sm">
                    @if(!$leaveType->trashed())
                        <form action="{{ route('leave-types.destroy', $leaveType) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete this leave type?')">
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
