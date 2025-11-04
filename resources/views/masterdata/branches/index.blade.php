@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title mb-0">Branches</h4>
                </div>
                <a href="{{ route('branches.create') }}" class="btn btn-primary-gradient">
                    <i class="cil-plus me-1"></i> Add New Branch
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="branches-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Address</th>
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
    $('#branches-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('branches.index') }}",
            type: "GET",
            error: function(xhr, error, thrown) {
                console.log('DataTables error:', error, thrown);
                console.log('Response:', xhr.responseText);
                // Hide processing indicator on error
                $('#branches-table_processing').hide();
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'code', name: 'code'},
            {data: 'address', name: 'address'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        initComplete: function() {
            // Ensure processing indicator is hidden when initialization is complete
            $('#branches-table_processing').hide();
        },
        drawCallback: function() {
            // Ensure processing indicator is hidden after each draw
            $('#branches-table_processing').hide();

            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }
    });
});
</script>
@endpush
