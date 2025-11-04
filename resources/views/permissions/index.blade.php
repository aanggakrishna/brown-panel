@extends('layouts.app')

@section('title')
Permission List
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">Permissions</h5>
                    <h6 class="card-subtitle text-muted">Manage your permissions here.</h6>
                </div>
                <a href="{{ route('permissions.create') }}" class="btn btn-primary-gradient">
                    <i class="cil-lock-locked me-1"></i> Add Permission
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="mt-2 mb-3">
                @include('layouts.includes.messages')
            </div>

            <table id="permissions-table" class="table table-striped table-hover w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Guard Name</th>
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
    $('#permissions-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('permissions.index') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'guard_name', name: 'guard_name' },
            { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
        ],
        order: [[0, 'asc']],
        language: {
            search: '',
            searchPlaceholder: 'Search permissions...'
        }
    });
});
</script>
@endpush
