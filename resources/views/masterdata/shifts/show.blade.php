@extends('layouts.app')

@section('title')
Shift Details - {{ $shift->name }}
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-header bg-info text-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">
                        <i class="cil-clock me-2"></i>Shift Details
                    </h5>
                    <p class="mb-0 opacity-75">{{ $shift->name }}</p>
                </div>
                <div class="btn-group">
                    <a href="{{ route('shifts.edit', $shift) }}" class="btn btn-light btn-sm">
                        <i class="cil-pencil me-1"></i> Edit
                    </a>
                    <a href="{{ route('shifts.index') }}" class="btn btn-secondary btn-sm">
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
                                <td class="fw-bold" style="width: 200px;">Shift Name:</td>
                                <td>{{ $shift->name }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Start Time:</td>
                                <td>
                                    <span class="badge bg-primary">{{ $shift->start_time }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">End Time:</td>
                                <td>
                                    <span class="badge bg-primary">{{ $shift->end_time }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Duration:</td>
                                <td>
                                    <span class="badge bg-success">{{ $shift->duration_hours }} hours</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Time Range:</td>
                                <td>
                                    <span class="badge bg-info">{{ $shift->start_time }} - {{ $shift->end_time }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Status:</td>
                                <td>
                                    @if($shift->is_active)
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
                                    @if($shift->description)
                                        {{ $shift->description }}
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
                                {{ $shift->created_at->format('M d, Y H:i') }}<br><br>
                                <strong>Last Updated:</strong><br>
                                {{ $shift->updated_at->format('M d, Y H:i') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            @if($shift->trashed())
                <div class="alert alert-warning mt-3">
                    <i class="cil-warning me-2"></i>
                    This shift has been deleted but can be restored.
                    <a href="{{ route('shifts.restore', $shift) }}" class="alert-link ms-2">
                        <i class="cil-reload me-1"></i>Restore Shift
                    </a>
                </div>
            @endif
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Shift ID: {{ $shift->id }}
                </small>
                <div class="btn-group btn-group-sm">
                    @if(!$shift->trashed())
                        <form action="{{ route('shifts.destroy', $shift) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete this shift?')">
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
