@extends('layouts.app')

@section('title')
{{ $user->name }} - Documents
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">{{ $user->name }} - Documents</h5>
                    <h6 class="card-subtitle text-muted">Manage employee documents here.</h6>
                </div>
                <div>
                    <a href="{{ route('user-documents.create', $user) }}" class="btn btn-primary-gradient">
                        <i class="cil-plus me-1"></i> Upload Document
                    </a>
                    <a href="{{ route('users.show', $user) }}" class="btn btn-secondary ms-2">
                        <i class="cil-arrow-left me-1"></i> Back to User
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="mt-2 mb-3">
                @include('layouts.includes.messages')
            </div>

            <table id="user-documents-table" class="table table-striped table-hover w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Document Type</th>
                        <th>File Name</th>
                        <th>File Size</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    var table = $('#user-documents-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('user-documents.index', $user->id) }}",
            type: "GET",
            error: function(xhr, error, thrown) {
                console.log('DataTables error:', error, thrown);
                console.log('Response:', xhr.responseText);
                // Hide processing indicator on error
                $('#user-documents-table_processing').hide();
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'document_type', name: 'document_type'},
            {data: 'file_name', name: 'file_name'},
            {data: 'file_size', name: 'file_size'},
            {data: 'uploaded_at', name: 'uploaded_at'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        initComplete: function() {
            // Ensure processing indicator is hidden when initialization is complete
            $('#user-documents-table_processing').hide();
        },
        drawCallback: function() {
            // Ensure processing indicator is hidden after each draw
            $('#user-documents-table_processing').hide();

            // Initialize Bootstrap tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }
    });
});
</script>
@endpush
