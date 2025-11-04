@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Leave Types</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="leave-types-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Max Days</th>
                            <th>Paid</th>
                            <th>Description</th>
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
    $('#leave-types-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('leave-types.index') }}",
            type: "GET",
            error: function(xhr, error, thrown) {
                console.log('DataTables error:', error, thrown);
                console.log('Response:', xhr.responseText);
                // Hide processing indicator on error
                $('#leave-types-table_processing').hide();
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'max_days_per_year', name: 'max_days_per_year'},
            {data: 'paid', name: 'paid'},
            {data: 'description', name: 'description'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        initComplete: function() {
            // Ensure processing indicator is hidden when initialization is complete
            $('#leave-types-table_processing').hide();
        },
        drawCallback: function() {
            // Ensure processing indicator is hidden after each draw
            $('#leave-types-table_processing').hide();

            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }
    });
});
</script>
@endpush
