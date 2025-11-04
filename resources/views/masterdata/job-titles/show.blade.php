@extends('layouts.app')

@section('title')
Job Title Details - {{ $jobTitle->name }}
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-header bg-info text-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">
                        <i class="cil-briefcase me-2"></i>Job Title Details
                    </h5>
                    <p class="mb-0 opacity-75">{{ $jobTitle->name }}</p>
                </div>
                <div class="btn-group">
                    <a href="{{ route('job-titles.edit', $jobTitle) }}" class="btn btn-light btn-sm">
                        <i class="cil-pencil me-1"></i> Edit
                    </a>
                    <a href="{{ route('job-titles.index') }}" class="btn btn-secondary btn-sm">
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
                                <td class="fw-bold" style="width: 200px;">Job Title Name:</td>
                                <td>{{ $jobTitle->name }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Department:</td>
                                <td>
                                    <span class="badge bg-primary">{{ $jobTitle->department->name }}</span>
                                    @if($jobTitle->department->code)
                                        <small class="text-muted ms-1">({{ $jobTitle->department->code }})</small>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Branch:</td>
                                <td>
                                    <span class="badge bg-secondary">{{ $jobTitle->department->branch->name }}</span>
                                    @if($jobTitle->department->branch->code)
                                        <small class="text-muted ms-1">({{ $jobTitle->department->branch->code }})</small>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Position Level:</td>
                                <td>
                                    <span class="badge bg-success">{{ $jobTitle->positionLevel->name }}</span>
                                    @if($jobTitle->positionLevel->code)
                                        <small class="text-muted ms-1">({{ $jobTitle->positionLevel->code }})</small>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Status:</td>
                                <td>
                                    @if($jobTitle->is_active)
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
                                    @if($jobTitle->description)
                                        {{ $jobTitle->description }}
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
                                {{ $jobTitle->created_at->format('M d, Y H:i') }}<br><br>
                                <strong>Last Updated:</strong><br>
                                {{ $jobTitle->updated_at->format('M d, Y H:i') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            @if($jobTitle->trashed())
                <div class="alert alert-warning mt-3">
                    <i class="cil-warning me-2"></i>
                    This job title has been deleted but can be restored.
                    <a href="{{ route('job-titles.restore', $jobTitle) }}" class="alert-link ms-2">
                        <i class="cil-reload me-1"></i>Restore Job Title
                    </a>
                </div>
            @endif
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Job Title ID: {{ $jobTitle->id }}
                </small>
                <div class="btn-group btn-group-sm">
                    @if(!$jobTitle->trashed())
                        <form action="{{ route('job-titles.destroy', $jobTitle) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete this job title?')">
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