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
    }    public function create()
    {
        $branches = \App\Models\Branch::where('is_active', true)->orderBy('name')->get();
        return view('masterdata.departments.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:departments,code',
            'description' => 'nullable|string|max:1000',
            'branch_id' => 'required|exists:branches,id',
            'is_active' => 'boolean'
        ]);

        Department::create($request->all());

        return redirect()->route('departments.index')
            ->with('success', 'Department created successfully.');
    }

    public function show(Department $department)
    {
        $department->load('branch');
        return view('masterdata.departments.show', compact('department'));
    }

    public function edit(Department $department)
    {
        $branches = \App\Models\Branch::where('is_active', true)->orderBy('name')->get();
        return view('masterdata.departments.edit', compact('department', 'branches'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:departments,code,' . $department->id,
            'description' => 'nullable|string|max:1000',
            'branch_id' => 'required|exists:branches,id',
            'is_active' => 'boolean'
        ]);

        $department->update($request->all());

        return redirect()->route('departments.index')
            ->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')
            ->with('success', 'Department deleted successfully.');
    }
}
