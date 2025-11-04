<?php

namespace App\Http\Controllers;

use App\Models\PositionLevel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PositionLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = PositionLevel::select('position_levels.*');

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('level', function ($row) {
                    return $row->level_order;
                })
                ->addColumn('status', function ($row) {
                    return $row->is_active
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-secondary">Inactive</span>';
                })
                ->addColumn('action', function ($row) {
                    $showUrl = route('position-levels.show', $row->id);
                    $editUrl = route('position-levels.edit', $row->id);
                    $deleteUrl = route('position-levels.destroy', $row->id);

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

        return view('masterdata.position-levels.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('masterdata.position-levels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level_order' => 'required|integer|min:1',
            'is_active' => 'boolean',
        ]);

        PositionLevel::create($request->all());

        return redirect()->route('position-levels.index')
            ->with('success', 'Position level created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PositionLevel $positionLevel)
    {
        return view('masterdata.position-levels.show', compact('positionLevel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PositionLevel $positionLevel)
    {
        return view('masterdata.position-levels.edit', compact('positionLevel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PositionLevel $positionLevel)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level_order' => 'required|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $positionLevel->update($request->all());

        return redirect()->route('position-levels.index')
            ->with('success', 'Position level updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PositionLevel $positionLevel)
    {
        $positionLevel->delete();

        return redirect()->route('position-levels.index')
            ->with('success', 'Position level deleted successfully.');
    }
}
