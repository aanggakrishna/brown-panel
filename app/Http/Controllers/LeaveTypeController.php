<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = LeaveType::select('leave_types.*');

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('paid', function ($row) {
                    return $row->is_paid
                        ? '<span class="badge bg-success">Paid</span>'
                        : '<span class="badge bg-warning">Unpaid</span>';
                })
                ->addColumn('status', function ($row) {
                    return $row->is_active
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-secondary">Inactive</span>';
                })
                ->addColumn('action', function ($row) {
                    $showUrl = route('leave-types.show', $row->id);
                    $editUrl = route('leave-types.edit', $row->id);
                    $deleteUrl = route('leave-types.destroy', $row->id);

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
                ->rawColumns(['paid', 'status', 'action'])
                ->make(true);
        }

        return view('masterdata.leave-types.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('masterdata.leave-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_days_per_year' => 'required|integer|min:0',
            'is_paid' => 'boolean',
            'is_active' => 'boolean',
        ]);

        LeaveType::create($request->all());

        return redirect()->route('leave-types.index')
            ->with('success', 'Leave type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LeaveType $leaveType)
    {
        return view('masterdata.leave-types.show', compact('leaveType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveType $leaveType)
    {
        return view('masterdata.leave-types.edit', compact('leaveType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeaveType $leaveType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_days_per_year' => 'required|integer|min:0',
            'is_paid' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $leaveType->update($request->all());

        return redirect()->route('leave-types.index')
            ->with('success', 'Leave type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaveType $leaveType)
    {
        $leaveType->delete();

        return redirect()->route('leave-types.index')
            ->with('success', 'Leave type deleted successfully.');
    }
}
