@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Leave Applications</h4>
            <a href="{{ route('leave-applications.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Apply for Leave
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="leave-applications-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Employee</th>
                            <th>Leave Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Applied Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
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
$(document).ready(function() {
    $('#leave-applications-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('leave-applications.index') }}",
            type: "GET",
            error: function(xhr, error, thrown) {
                console.log('DataTables error:', error, thrown);
                console.log('Response:', xhr.responseText);
                $('#leave-applications-table_processing').hide();
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'employee_name', name: 'employee_name'},
            {data: 'leave_type_name', name: 'leave_type_name'},
            {data: 'start_date', name: 'start_date'},
            {data: 'end_date', name: 'end_date'},
            {data: 'duration', name: 'duration'},
            {data: 'status_badge', name: 'status_badge', orderable: false},
            {data: 'applied_date', name: 'applied_date'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        initComplete: function() {
            $('#leave-applications-table_processing').hide();
        },
        drawCallback: function() {
            $('#leave-applications-table_processing').hide();

            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }
    });
});

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
                $('#leave-applications-table').DataTable().ajax.reload();
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