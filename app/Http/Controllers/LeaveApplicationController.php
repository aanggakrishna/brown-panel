<?php

namespace App\Http\Controllers;

use App\Models\LeaveApplication;
use App\Models\LeaveType;
use App\Models\LeaveBalance;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class LeaveApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = LeaveApplication::with(['user', 'leaveType', 'approver'])
                ->select('leave_applications.*');

            // Filter by current user if not admin/manager
            if (!auth()->user()->hasRole(['admin', 'manager'])) {
                $query->where('user_id', auth()->id());
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('employee_name', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('leave_type_name', function ($row) {
                    return $row->leaveType->name;
                })
                ->addColumn('duration', function ($row) {
                    return $row->duration_text;
                })
                ->addColumn('status_badge', function ($row) {
                    return $row->status_badge;
                })
                ->addColumn('applied_date', function ($row) {
                    return $row->created_at->format('M d, Y');
                })
                ->addColumn('action', function ($row) {
                    $actions = '';

                    if (auth()->user()->hasRole(['admin', 'manager']) && $row->status === 'pending') {
                        $actions .= '<button type="button" class="btn btn-success btn-sm me-1" onclick="approveLeave(' . $row->id . ')">Approve</button>';
                        $actions .= '<button type="button" class="btn btn-danger btn-sm me-1" onclick="rejectLeave(' . $row->id . ')">Reject</button>';
                    }

                    $actions .= '<a href="' . route('leave-applications.show', $row->id) . '" class="btn btn-info btn-sm">View</a>';

                    if ($row->user_id === auth()->id() && $row->status === 'pending') {
                        $actions .= ' <a href="' . route('leave-applications.edit', $row->id) . '" class="btn btn-warning btn-sm ms-1">Edit</a>';
                        $actions .= ' <form action="' . route('leave-applications.destroy', $row->id) . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Are you sure?\');">';
                        $actions .= csrf_field() . method_field('DELETE');
                        $actions .= '<button type="submit" class="btn btn-danger btn-sm ms-1">Cancel</button></form>';
                    }

                    return $actions;
                })
                ->rawColumns(['status_badge', 'action'])
                ->make(true);
        }

        return view('leave-applications.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $leaveTypes = LeaveType::where('is_active', true)->get();
        $currentBalance = $this->getCurrentLeaveBalance(auth()->id());

        return view('leave-applications.create', compact('leaveTypes', 'currentBalance'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'leave_type_id' => 'required|exists:leave_types,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:500',
            'notes' => 'nullable|string|max:500',
        ]);

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $totalDays = $startDate->diffInDays($endDate) + 1;

        // Check leave balance
        $currentBalance = $this->getCurrentLeaveBalance(auth()->id());
        if ($totalDays > $currentBalance) {
            return back()->withErrors(['end_date' => 'Insufficient leave balance. You have ' . $currentBalance . ' days remaining.'])->withInput();
        }

        // Check for overlapping leave applications
        $overlappingLeave = LeaveApplication::where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'approved'])
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                      ->orWhereBetween('end_date', [$startDate, $endDate])
                      ->orWhere(function ($q) use ($startDate, $endDate) {
                          $q->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                      });
            })
            ->exists();

        if ($overlappingLeave) {
            return back()->withErrors(['start_date' => 'You already have a leave application for this period.'])->withInput();
        }

        LeaveApplication::create([
            'user_id' => auth()->id(),
            'leave_type_id' => $request->leave_type_id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_days' => $totalDays,
            'reason' => $request->reason,
            'notes' => $request->notes,
        ]);

        return redirect()->route('leave-applications.index')
            ->with('success', 'Leave application submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LeaveApplication $leaveApplication)
    {
        // Check if user can view this application
        if (!auth()->user()->hasRole(['admin', 'manager']) && $leaveApplication->user_id !== auth()->id()) {
            abort(403);
        }

        $leaveApplication->load(['user', 'leaveType', 'approver']);

        return view('leave-applications.show', compact('leaveApplication'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveApplication $leaveApplication)
    {
        // Only allow editing own pending applications
        if ($leaveApplication->user_id !== auth()->id() || $leaveApplication->status !== 'pending') {
            abort(403);
        }

        $leaveTypes = LeaveType::where('is_active', true)->get();
        $currentBalance = $this->getCurrentLeaveBalance(auth()->id());

        return view('leave-applications.edit', compact('leaveApplication', 'leaveTypes', 'currentBalance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeaveApplication $leaveApplication)
    {
        // Only allow updating own pending applications
        if ($leaveApplication->user_id !== auth()->id() || $leaveApplication->status !== 'pending') {
            abort(403);
        }

        $request->validate([
            'leave_type_id' => 'required|exists:leave_types,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:500',
            'notes' => 'nullable|string|max:500',
        ]);

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $totalDays = $startDate->diffInDays($endDate) + 1;

        // Check leave balance (add back the original days first)
        $currentBalance = $this->getCurrentLeaveBalance(auth()->id()) + $leaveApplication->total_days;
        if ($totalDays > $currentBalance) {
            return back()->withErrors(['end_date' => 'Insufficient leave balance. You have ' . $currentBalance . ' days remaining.'])->withInput();
        }

        // Check for overlapping leave applications (excluding current)
        $overlappingLeave = LeaveApplication::where('user_id', auth()->id())
            ->where('id', '!=', $leaveApplication->id)
            ->whereIn('status', ['pending', 'approved'])
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                      ->orWhereBetween('end_date', [$startDate, $endDate])
                      ->orWhere(function ($q) use ($startDate, $endDate) {
                          $q->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                      });
            })
            ->exists();

        if ($overlappingLeave) {
            return back()->withErrors(['start_date' => 'You already have a leave application for this period.'])->withInput();
        }

        $leaveApplication->update([
            'leave_type_id' => $request->leave_type_id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_days' => $totalDays,
            'reason' => $request->reason,
            'notes' => $request->notes,
        ]);

        return redirect()->route('leave-applications.index')
            ->with('success', 'Leave application updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaveApplication $leaveApplication)
    {
        // Only allow cancelling own pending applications
        if ($leaveApplication->user_id !== auth()->id() || $leaveApplication->status !== 'pending') {
            abort(403);
        }

        $leaveApplication->delete();

        return redirect()->route('leave-applications.index')
            ->with('success', 'Leave application cancelled successfully.');
    }

    /**
     * Approve a leave application
     */
    public function approve(Request $request, LeaveApplication $leaveApplication)
    {
        if (!auth()->user()->hasRole(['admin', 'manager'])) {
            abort(403);
        }

        $leaveApplication->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'approval_notes' => $request->notes,
        ]);

        // Update leave balance
        $this->updateLeaveBalance($leaveApplication->user_id, $leaveApplication->total_days);

        return response()->json(['success' => true, 'message' => 'Leave application approved successfully.']);
    }

    /**
     * Reject a leave application
     */
    public function reject(Request $request, LeaveApplication $leaveApplication)
    {
        if (!auth()->user()->hasRole(['admin', 'manager'])) {
            abort(403);
        }

        $leaveApplication->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'approval_notes' => $request->notes,
        ]);

        return response()->json(['success' => true, 'message' => 'Leave application rejected.']);
    }

    /**
     * Get current leave balance for a user
     */
    private function getCurrentLeaveBalance($userId)
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $balance = LeaveBalance::where('user_id', $userId)
            ->where('year', $currentYear)
            ->where('month', $currentMonth)
            ->first();

        return $balance ? $balance->remaining_days : 0;
    }

    /**
     * Update leave balance after approval
     */
    private function updateLeaveBalance($userId, $usedDays)
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $balance = LeaveBalance::where('user_id', $userId)
            ->where('year', $currentYear)
            ->where('month', $currentMonth)
            ->first();

        if ($balance) {
            $balance->update([
                'used_days' => $balance->used_days + $usedDays,
                'remaining_days' => $balance->remaining_days - $usedDays,
            ]);
        }
    }
}
