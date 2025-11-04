<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $departments = Department::with('branch');

            return DataTables::of($departments)
                ->addIndexColumn()
                ->addColumn('code', function ($department) {
                    return $department->code;
                })
                ->addColumn('branch_name', function ($department) {
                    return $department->branch ? $department->branch->name : '-';
                })
                ->addColumn('status', function ($department) {
                    return $department->is_active
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })
                ->addColumn('action', function ($department) {
                    $showUrl = route('departments.show', $department->id);
                    $editUrl = route('departments.edit', $department->id);
                    $deleteUrl = route('departments.destroy', $department->id);

                    return '
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="' . $showUrl . '" class="btn btn-info-gradient" data-bs-toggle="tooltip" title="View">
                                👁️
                            </a>
                            <a href="' . $editUrl . '" class="btn btn-warning-gradient" data-bs-toggle="tooltip" title="Edit">
                                ✏️
                            </a>
                            <form action="' . $deleteUrl . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Are you sure?\');">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger-gradient" data-bs-toggle="tooltip" title="Delete">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('masterdata.departments.index');
    }    public function create() { }
    public function store(Request $request) { }
    public function show(Department $department) { }
    public function edit(Department $department) { }
    public function update(Request $request, Department $department) { }
    public function destroy(Department $department) { }
}
