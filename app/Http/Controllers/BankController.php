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
                    $viewBtn = '<a href="' . route('banks.show', $row->id) . '" class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="View">👁️</a>';
                    $editBtn = '<a href="' . route('banks.edit', $row->id) . '" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" title="Edit">✏️</a>';
                    $deleteBtn = '<form action="' . route('banks.destroy', $row->id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Delete" onclick="return confirm(\'Are you sure?\')">🗑️</button>
                    </form>';

                    return $viewBtn . ' ' . $editBtn . ' ' . $deleteBtn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('masterdata.banks.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Bank $bank)
    {
        //
    }

    public function edit(Bank $bank)
    {
        //
    }

    public function update(Request $request, Bank $bank)
    {
        //
    }

    public function destroy(Bank $bank)
    {
        //
    }
}
