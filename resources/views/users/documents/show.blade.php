@extends('layouts.app')

@section('title')
Document Details - {{ $user->name }}
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">Document Details</h5>
                    <h6 class="card-subtitle text-muted">{{ $document->document_type_label }} for {{ $user->name }}</h6>
                </div>
                <div>
                    <a href="{{ route('user-documents.download', [$user, $document]) }}" class="btn btn-success me-2">
                        <i class="cil-cloud-download me-1"></i> Download
                    </a>
                    <a href="{{ route('user-documents.edit', [$user, $document]) }}" class="btn btn-warning me-2">
                        <i class="cil-pencil me-1"></i> Edit
                    </a>
                    <a href="{{ route('user-documents.index', $user) }}" class="btn btn-secondary">
                        <i class="cil-arrow-left me-1"></i> Back to Documents
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Document Type</label>
                                <p class="mb-0">{{ $document->document_type_label }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">File Name</label>
                                <p class="mb-0">{{ $document->file_name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">File Size</label>
                                <p class="mb-0">{{ $document->file_size_formatted }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Upload Date</label>
                                <p class="mb-0">{{ $document->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Expiry Date</label>
                                <p class="mb-0">
                                    @if($document->expiry_date)
                                        {{ $document->expiry_date->format('d M Y') }}
                                        @if($document->is_expired)
                                            <span class="badge bg-danger ms-2">Expired</span>
                                        @elseif($document->is_expiring_soon)
                                            <span class="badge bg-warning ms-2">Expiring Soon</span>
                                        @endif
                                    @else
                                        <span class="text-muted">No expiry</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <p class="mb-0">{!! $document->status_badge !!}</p>
                            </div>
                        </div>
                    </div>
                    @if($document->notes)
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Notes</label>
                                <p class="mb-0">{{ $document->notes }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-md-4">
                    <div class="card border">
                        <div class="card-header">
                            <h6 class="mb-0">File Preview</h6>
                        </div>
                        <div class="card-body text-center">
                            @if(in_array(strtolower(pathinfo($document->file_name, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png']))
                                <img src="{{ asset('storage/' . $document->file_path) }}" alt="Document Preview" class="img-fluid rounded" style="max-height: 200px;">
                            @else
                                <div class="text-center">
                                    <i class="cil-file" style="font-size: 4rem; color: #6c757d;"></i>
                                    <p class="mt-2 text-muted">{{ strtoupper(pathinfo($document->file_name, PATHINFO_EXTENSION)) }} File</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this document? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('user-documents.destroy', [$user, $document]) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Document</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endpush