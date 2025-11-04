# DataTables Implementation Guide

This document provides a comprehensive guide for implementing serverside DataTables in the Laravel CoreUI project with brown-orange theme.

## Package Information

- **Package**: yajra/laravel-datatables-oracle
- **Version**: ^11.1
- **Documentation**: https://yajrabox.com/docs/laravel-datatables

## Installation

The DataTables package is already installed. If you need to reinstall:

```bash
composer require yajra/laravel-datatables-oracle
php artisan vendor:publish --tag=datatables
```

## Implementation Approach

We're using a **simplified approach** without DataTable classes. Instead, we handle DataTables directly in the controller using the Facade pattern.

### Why This Approach?

1. **Simpler**: No need to create separate DataTable classes
2. **Faster**: Less boilerplate code
3. **Flexible**: Easy to customize per route
4. **Maintainable**: All logic in one place (controller)

## Controller Implementation

### Basic Structure

```php
use Yajra\DataTables\Facades\DataTables;

public function index(Request $request)
{
    if ($request->ajax()) {
        $data = YourModel::query();
        
        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                // Action buttons here
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    return view('your.index');
}
```

### Users Controller Example

```php
public function index(Request $request)
{
    if ($request->ajax()) {
        $users = User::with('roles');
        
        return DataTables::of($users)
            ->addColumn('roles', function ($user) {
                if ($user->roles->isEmpty()) {
                    return '<span class="badge bg-secondary">No Role</span>';
                }
                return $user->roles->map(function ($role) {
                    return '<span class="badge bg-primary-gradient">' . $role->name . '</span>';
                })->implode(' ');
            })
            ->addColumn('action', function ($user) {
                $showUrl = route('users.show', $user->id);
                $editUrl = route('users.edit', $user->id);
                $deleteUrl = route('users.destroy', $user->id);

                return '
                    <div class="btn-group" role="group">
                        <a href="' . $showUrl . '" class="btn btn-sm btn-info-gradient" title="Show">
                            <i class="cil-eye"></i>
                        </a>
                        <a href="' . $editUrl . '" class="btn btn-sm btn-warning-gradient" title="Edit">
                            <i class="cil-pencil"></i>
                        </a>
                        <form action="' . $deleteUrl . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Are you sure?\');">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-danger-gradient" title="Delete">
                                <i class="cil-trash"></i>
                            </button>
                        </form>
                    </div>
                ';
            })
            ->rawColumns(['roles', 'action'])
            ->make(true);
    }

    return view('users.index');
}
```

## View Implementation

### Basic Table HTML

```blade
<table id="your-table" class="table table-striped table-hover w-100">
    <thead>
        <tr>
            <th>Column 1</th>
            <th>Column 2</th>
            <th>Action</th>
        </tr>
    </thead>
</table>
```

### JavaScript Initialization

```blade
@push('scripts')
<script>
$(document).ready(function() {
    $('#your-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('your.index') }}',
        columns: [
            { data: 'column1', name: 'column1' },
            { data: 'column2', name: 'column2' },
            { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
        ],
        order: [[0, 'asc']],
        language: {
            search: '',
            searchPlaceholder: 'Search...'
        }
    });
});
</script>
@endpush
```

## Styling with Brown-Orange Theme

All DataTables are styled using our custom brown-orange theme. The styling is defined in `resources/sass/_custom.scss`.

### Key Classes Used

- `.btn-primary-gradient` - Primary action buttons (brown-orange)
- `.btn-info-gradient` - Info/View buttons (cyan)
- `.btn-warning-gradient` - Edit buttons (yellow)
- `.btn-danger-gradient` - Delete buttons (red)
- `.badge.bg-primary-gradient` - Primary badges
- `.badge.bg-info-gradient` - Info badges

### DataTable Styling

```scss
.dataTables_wrapper {
    .dataTables_length select,
    .dataTables_filter input {
        border: 1px solid $brown-orange-300;
        border-radius: 8px;
        padding: 0.375rem 0.75rem;
        
        &:focus {
            border-color: $brown-orange-500;
            box-shadow: 0 0 0 0.2rem rgba($brown-orange-500, 0.25);
        }
    }
    
    .dataTables_paginate {
        .pagination {
            .page-link {
                color: $brown-orange-700;
                border-color: $brown-orange-300;
                
                &:hover {
                    background: linear-gradient(135deg, $brown-orange-500, $brown-orange-600);
                    color: white;
                }
            }
            
            .page-item.active .page-link {
                background: linear-gradient(135deg, $brown-orange-600, $brown-orange-700);
                border-color: $brown-orange-600;
            }
        }
    }
}
```

## Implemented Pages

The following pages are using serverside DataTables:

1. **Users** (`/users`)
   - Columns: ID, Name, Email, Username, Roles, Action
   - Features: Role badges, action buttons

2. **Roles** (`/roles`)
   - Columns: ID, Name, Permissions, Action
   - Features: Permission badges, action buttons

3. **Permissions** (`/permissions`)
   - Columns: ID, Name, Guard Name, Action
   - Features: Action buttons

## Advanced Features

### Custom Columns

```php
->addColumn('custom_column', function ($row) {
    return 'Custom Value: ' . $row->attribute;
})
```

### Edit Columns

```php
->editColumn('created_at', function ($row) {
    return $row->created_at->format('d M Y');
})
```

### Raw Columns

Always specify columns that contain HTML:

```php
->rawColumns(['action', 'status', 'badges'])
```

### Filtering

```php
->filter(function ($query) use ($request) {
    if ($request->has('status')) {
        $query->where('status', $request->status);
    }
})
```

### Ordering

```php
->orderColumn('column_name', function ($query, $order) {
    $query->orderBy('actual_column', $order);
})
```

## Performance Tips

1. **Use Eager Loading**: Always use `with()` to eager load relationships
   ```php
   $users = User::with('roles');
   ```

2. **Select Specific Columns**: Only select needed columns
   ```php
   $users = User::select(['id', 'name', 'email']);
   ```

3. **Index Database Columns**: Ensure searchable columns are indexed

4. **Use Query Scopes**: Create reusable query scopes in models

## Troubleshooting

### DataTable Not Loading

1. Check browser console for JavaScript errors
2. Verify route returns JSON for AJAX requests
3. Ensure jQuery and DataTables are loaded before initialization

### Columns Not Displaying

1. Check column names match between view and controller
2. Verify `rawColumns()` includes columns with HTML
3. Check data attribute names in columns array

### Search Not Working

1. Ensure `serverSide: true` is set
2. Check column `searchable` property
3. Verify model has searchable attributes

### Action Buttons Not Working

1. Use `rawColumns(['action'])` for HTML rendering
2. Escape quotes properly in HTML strings
3. Test routes exist and are accessible

## Additional Resources

- [Official Documentation](https://yajrabox.com/docs/laravel-datatables)
- [DataTables.net Documentation](https://datatables.net/)
- [Bootstrap 5 DataTables](https://datatables.net/examples/styling/bootstrap5.html)

## Creating New DataTable Page

To add DataTables to a new page:

1. **Update Controller**:
   ```php
   use Yajra\DataTables\Facades\DataTables;

   public function index(Request $request)
   {
       if ($request->ajax()) {
           $data = YourModel::query();
           return DataTables::of($data)
               ->addColumn('action', function ($row) {
                   // Action buttons
               })
               ->rawColumns(['action'])
               ->make(true);
       }
       return view('your.index');
   }
   ```

2. **Create View**:
   ```blade
   <table id="your-table" class="table table-striped table-hover w-100">
       <thead>
           <tr>
               <th>Columns</th>
           </tr>
       </thead>
   </table>
   
   @push('scripts')
   <script>
   $(document).ready(function() {
       $('#your-table').DataTable({
           processing: true,
           serverSide: true,
           ajax: '{{ route('your.index') }}',
           columns: [...]
       });
   });
   </script>
   @endpush
   ```

3. **Enjoy!** Your DataTable is ready with brown-orange theme styling.

---

**Last Updated**: January 2025  
**Author**: Laravel CoreUI Project Team
