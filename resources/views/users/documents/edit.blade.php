@extends('layouts.app')

@section('title')
Edit Document - {{ $user->name }}
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">Edit Document</h5>
                    <h6 class="card-subtitle text-muted">Edit document for {{ $user->name }}</h6>
                </div>
                <a href="{{ route('user-documents.index', $user) }}" class="btn btn-secondary">
                    <i class="cil-arrow-left me-1"></i> Back to Documents
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('user-documents.update', [$user, $document]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="document_type" class="form-label">Document Type <span class="text-danger">*</span></label>
                            <select name="document_type" id="document_type" class="form-select @error('document_type') is-invalid @enderror" required>
                                <option value="">Choose document type...</option>
                                <option value="ktp" {{ old('document_type', $document->document_type) == 'ktp' ? 'selected' : '' }}>KTP (Identity Card)</option>
                                <option value="npwp" {{ old('document_type', $document->document_type) == 'npwp' ? 'selected' : '' }}>NPWP (Tax ID)</option>
                                <option value="bpjs_kesehatan" {{ old('document_type', $document->document_type) == 'bpjs_kesehatan' ? 'selected' : '' }}>BPJS Kesehatan</option>
                                <option value="bpjs_tenaga_kerja" {{ old('document_type', $document->document_type) == 'bpjs_tenaga_kerja' ? 'selected' : '' }}>BPJS Tenaga Kerja</option>
                                <option value="ijazah" {{ old('document_type', $document->document_type) == 'ijazah' ? 'selected' : '' }}>Ijazah (Diploma)</option>
                                <option value="cv" {{ old('document_type', $document->document_type) == 'cv' ? 'selected' : '' }}>CV/Resume</option>
                                <option value="photo" {{ old('document_type', $document->document_type) == 'photo' ? 'selected' : '' }}>Photo</option>
                                <option value="contract" {{ old('document_type', $document->document_type) == 'contract' ? 'selected' : '' }}>Employment Contract</option>
                                <option value="other" {{ old('document_type', $document->document_type) == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('document_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="document_name" class="form-label">Document Name <span class="text-danger">*</span></label>
                            <input type="text" name="document_name" id="document_name" class="form-control @error('document_name') is-invalid @enderror"
                                   value="{{ old('document_name', $document->document_name) }}" placeholder="e.g., KTP - John Doe" required>
                            <div class="form-text">Give this document a descriptive name</div>
                            @error('document_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="document_file" class="form-label">Document File</label>
                            <input type="file" name="document_file" id="document_file" class="form-control @error('document_file') is-invalid @enderror"
                                   accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                            <div class="form-text">
                                Leave empty to keep current file. Accepted formats: PDF, JPG, PNG, DOC, DOCX. Max size: 5MB
                                @if($document->file_path)
                                    <br><strong>Current file:</strong> {{ $document->file_name }}
                                @endif
                            </div>
                            @error('document_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="expiry_date" class="form-label">Expiry Date</label>
                            <input type="date" name="expiry_date" id="expiry_date" class="form-control @error('expiry_date') is-invalid @enderror"
                                   value="{{ old('expiry_date', $document->expiry_date ? $document->expiry_date->format('Y-m-d') : '') }}">
                            <div class="form-text">Leave empty if document doesn't expire</div>
                            @error('expiry_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror" rows="3"
                                      placeholder="Additional notes about this document">{{ old('notes', $document->notes) }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="is_verified" id="is_verified" class="form-check-input" value="1"
                                       {{ old('is_verified', $document->is_verified) ? 'checked' : '' }}>
                                <label for="is_verified" class="form-check-label">
                                    Mark as verified
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('user-documents.index', $user) }}" class="btn btn-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary-gradient">
                        <i class="cil-save me-1"></i> Update Document
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // File validation
    $('#document_file').on('change', function() {
        var file = this.files[0];
        if (file) {
            var fileSize = file.size / 1024 / 1024; // in MB
            var allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

            if (fileSize > 5) {
                alert('File size must be less than 5MB');
                this.value = '';
                return;
            }

            if (!allowedTypes.includes(file.type)) {
                alert('Please select a valid file type (PDF, JPG, PNG, DOC, DOCX)');
                this.value = '';
                return;
            }
        }
    });
});
</script>
@endpush
