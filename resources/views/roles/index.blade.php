@extends('layouts.app')

@section('title')
Role list
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">Roles</h5>
                    <h6 class="card-subtitle text-muted">Manage your roles here.</h6>
                </div>
                <a href="{{ route('roles.create') }}" class="btn btn-primary-gradient">
                    <i class="cil-shield-alt me-1"></i> Add Role
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="mt-2 mb-3">
                @include('layouts.includes.messages')
            </div>

            <table id="roles-table" class="table table-striped table-hover w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Permissions</th>
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
    $('#roles-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('roles.index') }}',
            type: "GET",
            error: function(xhr, error, thrown) {
                console.log('DataTables error:', error, thrown);
                console.log('Response:', xhr.responseText);
                // Hide processing indicator on error
                $('#roles-table_processing').hide();
            }
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'permissions', name: 'permissions', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
        ],
        order: [[0, 'asc']],
        language: {
            search: '',
            searchPlaceholder: 'Search roles...'
        },
        initComplete: function() {
            // Ensure processing indicator is hidden when initialization is complete
            $('#roles-table_processing').hide();
        },
        drawCallback: function() {
            // Ensure processing indicator is hidden after each draw
            $('#roles-table_processing').hide();

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
