@extends('layouts.app')

@section('title')
User List
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">Users</h5>
                    <h6 class="card-subtitle text-muted">Manage your users here.</h6>
                </div>
                <a href="{{ route('users.create') }}" class="btn btn-primary-gradient">
                    <i class="cil-user-plus me-1"></i> Add User
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="mt-2 mb-3">
                @include('layouts.includes.messages')
            </div>

            <table id="users-table" class="table table-striped table-hover w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Roles</th>
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
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('users.index') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'username', name: 'username' },
            { data: 'roles', name: 'roles', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
        ],
        order: [[0, 'asc']],
        language: {
            search: '',
            searchPlaceholder: 'Search users...'
        }
    });
});
</script>
@endpush
