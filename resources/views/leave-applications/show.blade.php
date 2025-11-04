@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Leave Application Details</h4>
                    <a href="{{ route('leave-applications.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Employee</label>
                                <p class="mb-0">{{ $leaveApplication->user->name }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Leave Type</label>
                                <p class="mb-0">{{ $leaveApplication->leaveType->name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Start Date</label>
                                <p class="mb-0">{{ $leaveApplication->start_date->format('M d, Y') }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">End Date</label>
                                <p class="mb-0">{{ $leaveApplication->end_date->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Duration</label>
                                <p class="mb-0">{{ $leaveApplication->duration_text }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <p class="mb-0">{!! $leaveApplication->status_badge !!}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Reason</label>
                        <p class="mb-0">{{ $leaveApplication->reason }}</p>
                    </div>

                    @if($leaveApplication->notes)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Additional Notes</label>
                            <p class="mb-0">{{ $leaveApplication->notes }}</p>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Applied Date</label>
                                <p class="mb-0">{{ $leaveApplication->created_at->format('M d, Y \a\t h:i A') }}</p>
                            </div>
                        </div>

                        @if($leaveApplication->approved_at)
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">{{ $leaveApplication->status === 'approved' ? 'Approved' : 'Rejected' }} Date</label>
                                    <p class="mb-0">{{ $leaveApplication->approved_at->format('M d, Y \a\t h:i A') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    @if($leaveApplication->approver)
                        <div class="mb-3">
                            <label class="form-label fw-bold">{{ $leaveApplication->status === 'approved' ? 'Approved' : 'Rejected' }} By</label>
                            <p class="mb-0">{{ $leaveApplication->approver->name }}</p>
                        </div>
                    @endif

                    @if($leaveApplication->approval_notes)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Approval Notes</label>
                            <p class="mb-0">{{ $leaveApplication->approval_notes }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            @if(auth()->user()->hasRole(['admin', 'manager']) && $leaveApplication->status === 'pending')
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Approval Actions</h5>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-success btn-sm w-100 mb-2" onclick="approveLeave({{ $leaveApplication->id }})">
                            <i class="fas fa-check me-2"></i>Approve Leave
                        </button>
                        <button type="button" class="btn btn-danger btn-sm w-100" onclick="rejectLeave({{ $leaveApplication->id }})">
                            <i class="fas fa-times me-2"></i>Reject Leave
                        </button>
                    </div>
                </div>
            @endif

            @if($leaveApplication->user_id === auth()->id() && $leaveApplication->status === 'pending')
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Actions</h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('leave-applications.edit', $leaveApplication) }}" class="btn btn-warning btn-sm w-100 mb-2">
                            <i class="fas fa-edit me-2"></i>Edit Application
                        </a>
                        <form action="{{ route('leave-applications.destroy', $leaveApplication) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this leave application?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm w-100">
                                <i class="fas fa-trash me-2"></i>Cancel Application
                            </button>
                        </form>
                    </div>
                </div>
            @endif

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title">Leave Information</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <h4 class="text-primary">{{ $leaveApplication->total_days }}</h4>
                            <small class="text-muted">Requested Days</small>
                        </div>
                        <div class="col-6">
                            <h4 class="text-info">{{ $leaveApplication->leaveType->max_days_per_year ?? 'N/A' }}</h4>
                            <small class="text-muted">Max per Year</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Approve/Reject Modal -->
<div class="modal fade" id="approvalModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Approve Leave Application</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="approvalForm">
                <div class="modal-body">
                    <input type="hidden" id="leaveId" name="leave_id">
                    <div class="mb-3">
                        <label for="approvalNotes" class="form-label">Notes (Optional)</label>
                        <textarea class="form-control" id="approvalNotes" name="notes" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="modalSubmitBtn">Approve</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Approve leave function
function approveLeave(id) {
    $('#leaveId').val(id);
    $('#modalTitle').text('Approve Leave Application');
    $('#modalSubmitBtn').removeClass('btn-danger').addClass('btn-success').text('Approve');
    $('#approvalForm').attr('action', '{{ url("leave-applications") }}/' + id + '/approve');
    $('#approvalModal').modal('show');
}

// Reject leave function
function rejectLeave(id) {
    $('#leaveId').val(id);
    $('#modalTitle').text('Reject Leave Application');
    $('#modalSubmitBtn').removeClass('btn-success').addClass('btn-danger').text('Reject');
    $('#approvalForm').attr('action', '{{ url("leave-applications") }}/' + id + '/reject');
    $('#approvalModal').modal('show');
}

// Handle approval/rejection form submission
$('#approvalForm').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        url: $(this).attr('action'),
        method: 'POST',
        data: $(this).serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                $('#approvalModal').modal('hide');
                location.reload();
                toastr.success(response.message);
            }
        },
        error: function(xhr) {
            toastr.error('An error occurred while processing the request.');
        }
    });
});
</script>
@endpush