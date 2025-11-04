<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UserDocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, User $user)
    {
        if ($request->ajax()) {
            $documents = UserDocument::where('user_id', $user->id)->with('user');

            return DataTables::of($documents)
                ->addIndexColumn()
                ->addColumn('document_type_label', function ($document) {
                    return $document->document_type_label;
                })
                ->addColumn('file_size_formatted', function ($document) {
                    return $document->file_size_formatted;
                })
                ->addColumn('expiry_date', function ($document) {
                    return $document->expiry_date ? $document->expiry_date->format('d/m/Y') : '-';
                })
                ->addColumn('status', function ($document) {
                    return $document->status_badge;
                })
                ->addColumn('action', function ($document) {
                    $showUrl = route('user-documents.show', [$document->user_id, $document->id]);
                    $downloadUrl = route('user-documents.download', [$document->user_id, $document->id]);
                    $editUrl = route('user-documents.edit', [$document->user_id, $document->id]);
                    $deleteUrl = route('user-documents.destroy', [$document->user_id, $document->id]);

                    return '
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="' . $showUrl . '" class="btn btn-info-gradient" data-bs-toggle="tooltip" title="View">
                                �️
                            </a>
                            <a href="' . $downloadUrl . '" class="btn btn-success-gradient" data-bs-toggle="tooltip" title="Download">
                                📥
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

        return view('users.documents.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        $documentTypes = [
            'ktp' => 'KTP',
            'npwp' => 'NPWP',
            'bpjs_health' => 'BPJS Kesehatan',
            'bpjs_employment' => 'BPJS Ketenagakerjaan',
            'ijazah' => 'Ijazah',
            'cv' => 'CV/Resume',
            'photo' => 'Foto',
            'contract' => 'Kontrak Kerja',
            'certificate' => 'Sertifikat',
            'other' => 'Dokumen Lainnya'
        ];

        return view('users.documents.create', compact('user', 'documentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {
        $request->validate([
            'document_type' => 'required|string',
            'document_name' => 'required|string|max:255',
            'document_file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120', // 5MB max
            'expiry_date' => 'nullable|date|after:today',
            'notes' => 'nullable|string|max:1000'
        ]);

        $file = $request->file('document_file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('user-documents/' . $user->id, $fileName, 'public');

        UserDocument::create([
            'user_id' => $user->id,
            'document_type' => $request->document_type,
            'document_name' => $request->document_name,
            'file_path' => $filePath,
            'file_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'expiry_date' => $request->expiry_date,
            'notes' => $request->notes
        ]);

        return redirect()->route('user-documents.index', $user->id)
            ->with('success', 'Document uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, UserDocument $document)
    {
        // Ensure document belongs to user
        if ($document->user_id !== $user->id) {
            abort(403);
        }

        return view('users.documents.show', compact('user', 'document'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user, UserDocument $document)
    {
        // Ensure document belongs to user
        if ($document->user_id !== $user->id) {
            abort(403);
        }

        $documentTypes = [
            'ktp' => 'KTP',
            'npwp' => 'NPWP',
            'bpjs_health' => 'BPJS Kesehatan',
            'bpjs_employment' => 'BPJS Ketenagakerjaan',
            'ijazah' => 'Ijazah',
            'cv' => 'CV/Resume',
            'photo' => 'Foto',
            'contract' => 'Kontrak Kerja',
            'certificate' => 'Sertifikat',
            'other' => 'Dokumen Lainnya'
        ];

        return view('users.documents.edit', compact('user', 'document', 'documentTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user, UserDocument $document)
    {
        // Ensure document belongs to user
        if ($document->user_id !== $user->id) {
            abort(403);
        }

        $request->validate([
            'document_type' => 'required|string',
            'document_name' => 'required|string|max:255',
            'document_file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'expiry_date' => 'nullable|date',
            'notes' => 'nullable|string|max:1000',
            'is_verified' => 'boolean'
        ]);

        $updateData = [
            'document_type' => $request->document_type,
            'document_name' => $request->document_name,
            'expiry_date' => $request->expiry_date,
            'notes' => $request->notes,
            'is_verified' => $request->has('is_verified')
        ];

        // Handle file upload if new file is provided
        if ($request->hasFile('document_file')) {
            // Delete old file
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }

            $file = $request->file('document_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('user-documents/' . $user->id, $fileName, 'public');

            $updateData['file_path'] = $filePath;
            $updateData['file_name'] = $file->getClientOriginalName();
            $updateData['mime_type'] = $file->getMimeType();
            $updateData['file_size'] = $file->getSize();
        }

        $document->update($updateData);

        return redirect()->route('user-documents.index', $user->id)
            ->with('success', 'Document updated successfully.');
    }

    /**
     * Download the specified document.
     */
    public function download(User $user, UserDocument $document)
    {
        // Ensure document belongs to user
        if ($document->user_id !== $user->id) {
            abort(403);
        }

        if (!Storage::disk('public')->exists($document->file_path)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        return response()->download(storage_path('app/public/' . $document->file_path), $document->file_name);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, UserDocument $document)
    {
        // Ensure document belongs to user
        if ($document->user_id !== $user->id) {
            abort(403);
        }

        // Delete file from storage
        if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return redirect()->route('user-documents.index', $user->id)
            ->with('success', 'Document deleted successfully.');
    }
}
