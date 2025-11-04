<?php

namespace App\Http\Controllers;

use App\Models\JobTitle;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JobTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = JobTitle::with(['department.branch', 'positionLevel'])
                ->select('job_titles.*');

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('department_name', function ($row) {
                    return $row->department ? $row->department->name : '-';
                })
                ->addColumn('branch_name', function ($row) {
                    return $row->department && $row->department->branch ? $row->department->branch->name : '-';
                })
                ->addColumn('position_level_name', function ($row) {
                    return $row->positionLevel ? $row->positionLevel->name : '-';
                })
                ->addColumn('status', function ($row) {
                    return $row->is_active
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-secondary">Inactive</span>';
                })
                ->addColumn('action', function ($row) {
                    $showUrl = route('job-titles.show', $row->id);
                    $editUrl = route('job-titles.edit', $row->id);
                    $deleteUrl = route('job-titles.destroy', $row->id);

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

        return view('masterdata.job-titles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = \App\Models\Department::where('is_active', true)->get();
        $positionLevels = \App\Models\PositionLevel::where('is_active', true)->get();

        return view('masterdata.job-titles.create', compact('departments', 'positionLevels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'department_id' => 'required|exists:departments,id',
            'position_level_id' => 'required|exists:position_levels,id',
            'is_active' => 'boolean',
        ]);

        JobTitle::create($request->all());

        return redirect()->route('job-titles.index')
            ->with('success', 'Job title created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobTitle $jobTitle)
    {
        $jobTitle->load(['department.branch', 'positionLevel']);

        return view('masterdata.job-titles.show', compact('jobTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobTitle $jobTitle)
    {
        $departments = \App\Models\Department::where('is_active', true)->get();
        $positionLevels = \App\Models\PositionLevel::where('is_active', true)->get();

        return view('masterdata.job-titles.edit', compact('jobTitle', 'departments', 'positionLevels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobTitle $jobTitle)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'department_id' => 'required|exists:departments,id',
            'position_level_id' => 'required|exists:position_levels,id',
            'is_active' => 'boolean',
        ]);

        $jobTitle->update($request->all());

        return redirect()->route('job-titles.index')
            ->with('success', 'Job title updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobTitle $jobTitle)
    {
        $jobTitle->delete();

        return redirect()->route('job-titles.index')
            ->with('success', 'Job title deleted successfully.');
    }
}
