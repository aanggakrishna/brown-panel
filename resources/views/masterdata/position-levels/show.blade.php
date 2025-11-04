@extends('layouts.app')

@section('title')
Position Level Details - {{ $positionLevel->name }}
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-header bg-info text-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">
                        <i class="cil-layers me-2"></i>Position Level Details
                    </h5>
                    <p class="mb-0 opacity-75">{{ $positionLevel->name }}</p>
                </div>
                <div class="btn-group">
                    <a href="{{ route('position-levels.edit', $positionLevel) }}" class="btn btn-light btn-sm">
                        <i class="cil-pencil me-1"></i> Edit
                    </a>
                    <a href="{{ route('position-levels.index') }}" class="btn btn-secondary btn-sm">
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
                                <td class="fw-bold" style="width: 200px;">Position Level Name:</td>
                                <td>{{ $positionLevel->name }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Level Order:</td>
                                <td>
                                    <span class="badge bg-primary">{{ $positionLevel->level_order }}</span>
                                    <small class="text-muted ms-2">(Lower numbers = higher positions)</small>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Status:</td>
                                <td>
                                    @if($positionLevel->is_active)
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
                                    @if($positionLevel->description)
                                        {{ $positionLevel->description }}
                                    @else
                                        <span class="text-muted">No description provided</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Job Titles Count:</td>
                                <td>
                                    <span class="badge bg-secondary">{{ $positionLevel->jobTitles->count() }}</span>
                                    @if($positionLevel->jobTitles->count() > 0)
                                        <small class="text-muted ms-2">
                                            ({{ $positionLevel->jobTitles->where('is_active', true)->count() }} active)
                                        </small>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    @if($positionLevel->jobTitles->count() > 0)
                        <div class="mt-4">
                            <h6 class="mb-3">
                                <i class="cil-briefcase me-2"></i>Associated Job Titles
                            </h6>
                            <div class="row">
                                @foreach($positionLevel->jobTitles as $jobTitle)
                                    <div class="col-md-6 mb-2">
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-light text-dark me-2">{{ $jobTitle->name }}</span>
                                            @if($jobTitle->department)
                                                <small class="text-muted">
                                                    ({{ $jobTitle->department->name }})
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
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
                                {{ $positionLevel->created_at->format('M d, Y H:i') }}<br><br>
                                <strong>Last Updated:</strong><br>
                                {{ $positionLevel->updated_at->format('M d, Y H:i') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            @if($positionLevel->trashed())
                <div class="alert alert-warning mt-3">
                    <i class="cil-warning me-2"></i>
                    This position level has been deleted but can be restored.
                    <a href="{{ route('position-levels.restore', $positionLevel) }}" class="alert-link ms-2">
                        <i class="cil-reload me-1"></i>Restore Position Level
                    </a>
                </div>
            @endif
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Position Level ID: {{ $positionLevel->id }}
                </small>
                <div class="btn-group btn-group-sm">
                    @if(!$positionLevel->trashed())
                        <form action="{{ route('position-levels.destroy', $positionLevel) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete this position level?')">
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