<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BankController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $banks = Bank::query();

            return DataTables::of($banks)
                ->addIndexColumn()
                ->addColumn('status', function ($bank) {
                    return $bank->is_active
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })
                ->addColumn('action', function ($row) {
                    $showUrl = route('banks.show', $row->id);
                    $editUrl = route('banks.edit', $row->id);
                    $deleteUrl = route('banks.destroy', $row->id);

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

        return view('masterdata.banks.index');
    }

    public function create()
    {
        return view('masterdata.banks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:banks,code',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'boolean'
        ]);

        Bank::create($request->all());

        return redirect()->route('banks.index')
            ->with('success', 'Bank created successfully.');
    }

    public function show(Bank $bank)
    {
        return view('masterdata.banks.show', compact('bank'));
    }

    public function edit(Bank $bank)
    {
        return view('masterdata.banks.edit', compact('bank'));
    }

    public function update(Request $request, Bank $bank)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:banks,code,' . $bank->id,
            'description' => 'nullable|string|max:1000',
            'is_active' => 'boolean'
        ]);

        $bank->update($request->all());

        return redirect()->route('banks.index')
            ->with('success', 'Bank updated successfully.');
    }

    public function destroy(Bank $bank)
    {
        $bank->delete();

        return redirect()->route('banks.index')
            ->with('success', 'Bank deleted successfully.');
    }
}
