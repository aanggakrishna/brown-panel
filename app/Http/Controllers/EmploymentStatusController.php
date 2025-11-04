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
                    $viewBtn = '<a href="' . route('employment-statuses.show', $row->id) . '" class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="View">👁️</a>';
                    $editBtn = '<a href="' . route('employment-statuses.edit', $row->id) . '" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" title="Edit">✏️</a>';
                    $deleteBtn = '<form action="' . route('employment-statuses.destroy', $row->id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Delete" onclick="return confirm(\'Are you sure?\')">🗑️</button>
                    </form>';

                    return $viewBtn . ' ' . $editBtn . ' ' . $deleteBtn;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
