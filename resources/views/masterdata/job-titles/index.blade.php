@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title mb-0">Job Titles</h4>
                </div>
                <a href="{{ route('job-titles.create') }}" class="btn btn-primary-gradient">
                    <i class="cil-plus me-1"></i> Add New Job Title
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="job-titles-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Branch</th>
                            <th>Position Level</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#job-titles-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('job-titles.index') }}",
            type: "GET",
            error: function(xhr, error, thrown) {
                console.log('DataTables error:', error, thrown);
                console.log('Response:', xhr.responseText);
                // Hide processing indicator on error
                $('#job-titles-table_processing').hide();
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'department_name', name: 'department.name'},
            {data: 'branch_name', name: 'department.branch.name'},
            {data: 'position_level_name', name: 'positionLevel.name'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        initComplete: function() {
            // Ensure processing indicator is hidden when initialization is complete
            $('#job-titles-table_processing').hide();
        },
        drawCallback: function() {
            // Ensure processing indicator is hidden after each draw
            $('#job-titles-table_processing').hide();

            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }
    });
});
</script>
@endpush
