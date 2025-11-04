<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Yajra\DataTables\Facades\DataTables;

/**
 *
 */
class UsersController extends Controller
{
    /**
     * Display all users
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with('roles');

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('username', function ($user) {
                    return $user->username;
                })
                ->addColumn('roles', function ($user) {
                    if ($user->roles->isEmpty()) {
                        return '<span class="badge bg-secondary">No Role</span>';
                    }
                    return $user->roles->map(function ($role) {
                        return '<span class="badge bg-primary-gradient">' . $role->name . '</span>';
                    })->implode(' ');
                })
                ->addColumn('action', function ($user) {
                    $showUrl = route('users.show', $user->id);
                    $editUrl = route('users.edit', $user->id);
                    $documentsUrl = route('user-documents.index', $user->id);
                    $deleteUrl = route('users.destroy', $user->id);

                    return '
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="' . $showUrl . '" class="btn btn-info-gradient" data-bs-toggle="tooltip" title="View">
                                👁️
                            </a>
                            <a href="' . $documentsUrl . '" class="btn btn-success-gradient" data-bs-toggle="tooltip" title="Documents">
                                📁
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
                ->rawColumns(['roles', 'action'])
                ->make(true);
        }

        return view('users.index');
    }

    /**
     * Show form for creating user
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::latest()->get();

        return view('users.create', [
            'roles' => $roles,
            'branches' => \App\Models\Branch::where('is_active', true)->get(),
            'departments' => \App\Models\Department::where('is_active', true)->get(),
            'jobTitles' => \App\Models\JobTitle::where('is_active', true)->get(),
            'employmentStatuses' => \App\Models\EmploymentStatus::where('is_active', true)->get(),
            'positionLevels' => \App\Models\PositionLevel::where('is_active', true)->get(),
        ]);
    }

    /**
     * Store a newly created user
     *
     * @param User $user
     * @param StoreUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photoFile = $request->file('photo');
            $photoName = time() . '_' . uniqid() . '.' . $photoFile->getClientOriginalExtension();
            $photoPath = $photoFile->storeAs('user-photos', $photoName, 'public');
            $data['photo_path'] = $photoPath;
        }

        // Remove role from data as it's handled separately
        $role = $data['role'];
        unset($data['role']);

        // Create user with default password (should be changed later)
        $data['password'] = bcrypt('password123'); // Default password, should be changed

        $user = User::create($data);

        // Assign role
        $user->assignRole($role);

        return redirect()->route('users.index')
            ->withSuccess(__('User created successfully.'));
    }

    /**
     * Show user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // Eager load all relationships for better performance
        $user->load([
            'roles',
            'branch',
            'department',
            'jobTitle',
            'positionLevel',
            'employmentStatus',
            'bank',
            'documents'
        ]);

        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Edit user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // Eager load relationships to avoid N+1 queries
        $user->load('roles');

        return view('users.edit', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::latest()->get(),
            'branches' => \App\Models\Branch::where('is_active', true)->get(),
            'departments' => \App\Models\Department::where('is_active', true)->get(),
            'jobTitles' => \App\Models\JobTitle::where('is_active', true)->get(),
            'employmentStatuses' => \App\Models\EmploymentStatus::where('is_active', true)->get(),
            'positionLevels' => \App\Models\PositionLevel::where('is_active', true)->get(),
        ]);
    }

    /**
     * Update user data
     *
     * @param User $user
     * @param ProfileUpdateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, ProfileUpdateRequest $request)
    {
        $data = $request->validated();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo_path && Storage::disk('public')->exists($user->photo_path)) {
                Storage::disk('public')->delete($user->photo_path);
            }

            $photoFile = $request->file('photo');
            $photoName = time() . '_' . uniqid() . '.' . $photoFile->getClientOriginalExtension();
            $photoPath = $photoFile->storeAs('user-photos', $photoName, 'public');
            $data['photo_path'] = $photoPath;
        }

        // Remove role from data as it's handled separately
        $role = $data['role'];
        unset($data['role']);

        $user->update($data);

        // Sync role
        $user->syncRoles([$role]);

        return redirect()->route('users.show', $user)
            ->withSuccess(__('User updated successfully.'));
    }

    /**
     * Delete user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->withSuccess(__('User deleted successfully.'));
    }
}
