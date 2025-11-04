<?php

namespace App\Http\Controllers;

use App\Models\EmploymentStatus;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmploymentStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = EmploymentStatus::select('employment_statuses.*');

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return $row->is_active
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-secondary">Inactive</span>';
                })
                ->addColumn('action', function ($row) {
                    $showUrl = route('employment-statuses.show', $row->id);
                    $editUrl = route('employment-statuses.edit', $row->id);
                    $deleteUrl = route('employment-statuses.destroy', $row->id);

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

        return view('masterdata.employment-statuses.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('masterdata.employment-statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        EmploymentStatus::create($request->all());

        return redirect()->route('employment-statuses.index')
            ->with('success', 'Employment status created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmploymentStatus $employmentStatus)
    {
        return view('masterdata.employment-statuses.show', compact('employmentStatus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmploymentStatus $employmentStatus)
    {
        return view('masterdata.employment-statuses.edit', compact('employmentStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmploymentStatus $employmentStatus)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $employmentStatus->update($request->all());

        return redirect()->route('employment-statuses.index')
            ->with('success', 'Employment status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmploymentStatus $employmentStatus)
    {
        $employmentStatus->delete();

        return redirect()->route('employment-statuses.index')
            ->with('success', 'Employment status deleted successfully.');
    }
}
