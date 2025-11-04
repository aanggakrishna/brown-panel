@extends('layouts.app')

@section('title')
Company Settings
@endsection

@section('content')
<div class="bg-light rounded">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">
                        <i class="cil-building me-2"></i>Company Settings
                    </h5>
                    <p class="mb-0 opacity-75">Manage your company information and settings</p>
                </div>
            </div>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="cil-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-coreui-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('company-settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <!-- Company Basic Information -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-primary">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="cil-info me-2 text-primary"></i>Basic Information
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="company_name" class="form-label">Company Name <span class="text-danger">*</span></label>
                                            <input type="text" name="company_name" id="company_name" class="form-control @error('company_name') is-invalid @enderror"
                                                   value="{{ old('company_name', $settings->company_name) }}" required>
                                            @error('company_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="company_name_short" class="form-label">Company Short Name</label>
                                            <input type="text" name="company_name_short" id="company_name_short" class="form-control @error('company_name_short') is-invalid @enderror"
                                                   value="{{ old('company_name_short', $settings->company_name_short) }}"
                                                   placeholder="e.g., PT ABC">
                                            @error('company_name_short')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="company_description" class="form-label">Company Description</label>
                                    <textarea name="company_description" id="company_description" class="form-control @error('company_description') is-invalid @enderror"
                                              rows="3" placeholder="Brief description about your company">{{ old('company_description', $settings->company_description) }}</textarea>
                                    @error('company_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="company_logo" class="form-label">Company Logo</label>
                                            <input type="file" name="company_logo" id="company_logo" class="form-control @error('company_logo') is-invalid @enderror"
                                                   accept="image/*">
                                            <div class="form-text">Accepted formats: JPG, PNG, GIF, SVG. Max size: 2MB</div>
                                            @error('company_logo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @if($settings->company_logo_url)
                                                <div class="mt-2">
                                                    <img src="{{ $settings->company_logo_url }}" alt="Current Logo" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                                                    <p class="text-muted small mt-1">Current logo will be replaced if you upload a new one.</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="company_favicon" class="form-label">Company Favicon</label>
                                            <input type="file" name="company_favicon" id="company_favicon" class="form-control @error('company_favicon') is-invalid @enderror"
                                                   accept="image/*,.ico">
                                            <div class="form-text">Accepted formats: JPG, PNG, GIF, ICO. Max size: 1MB</div>
                                            @error('company_favicon')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @if($settings->company_favicon_url)
                                                <div class="mt-2">
                                                    <img src="{{ $settings->company_favicon_url }}" alt="Current Favicon" class="img-thumbnail" style="max-width: 64px; max-height: 64px;">
                                                    <p class="text-muted small mt-1">Current favicon will be replaced if you upload a new one.</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-success">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="cil-phone me-2 text-success"></i>Contact Information
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="company_email" class="form-label">Company Email <span class="text-danger">*</span></label>
                                            <input type="email" name="company_email" id="company_email" class="form-control @error('company_email') is-invalid @enderror"
                                                   value="{{ old('company_email', $settings->company_email) }}" required>
                                            @error('company_email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="company_phone" class="form-label">Company Phone <span class="text-danger">*</span></label>
                                            <input type="text" name="company_phone" id="company_phone" class="form-control @error('company_phone') is-invalid @enderror"
                                                   value="{{ old('company_phone', $settings->company_phone) }}" required>
                                            @error('company_phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="company_website" class="form-label">Company Website</label>
                                    <input type="url" name="company_website" id="company_website" class="form-control @error('company_website') is-invalid @enderror"
                                           value="{{ old('company_website', $settings->company_website) }}"
                                           placeholder="https://www.yourcompany.com">
                                    @error('company_website')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Address Information -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-info">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="cil-location-pin me-2 text-info"></i>Address Information
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="company_address" class="form-label">Company Address <span class="text-danger">*</span></label>
                                    <textarea name="company_address" id="company_address" class="form-control @error('company_address') is-invalid @enderror"
                                              rows="3" required>{{ old('company_address', $settings->company_address) }}</textarea>
                                    @error('company_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="company_city" class="form-label">City <span class="text-danger">*</span></label>
                                            <input type="text" name="company_city" id="company_city" class="form-control @error('company_city') is-invalid @enderror"
                                                   value="{{ old('company_city', $settings->company_city) }}" required>
                                            @error('company_city')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="company_province" class="form-label">Province</label>
                                            <input type="text" name="company_province" id="company_province" class="form-control @error('company_province') is-invalid @enderror"
                                                   value="{{ old('company_province', $settings->company_province) }}">
                                            @error('company_province')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="company_postal_code" class="form-label">Postal Code</label>
                                            <input type="text" name="company_postal_code" id="company_postal_code" class="form-control @error('company_postal_code') is-invalid @enderror"
                                                   value="{{ old('company_postal_code', $settings->company_postal_code) }}">
                                            @error('company_postal_code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="company_country" class="form-label">Country <span class="text-danger">*</span></label>
                                            <input type="text" name="company_country" id="company_country" class="form-control @error('company_country') is-invalid @enderror"
                                                   value="{{ old('company_country', $settings->company_country ?? 'Indonesia') }}" required>
                                            @error('company_country')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Legal Information -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-warning">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="cil-file me-2 text-warning"></i>Legal Information
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="npwp_number" class="form-label">NPWP Number</label>
                                            <input type="text" name="npwp_number" id="npwp_number" class="form-control @error('npwp_number') is-invalid @enderror"
                                                   value="{{ old('npwp_number', $settings->npwp_number) }}"
                                                   placeholder="e.g., 01.234.567.8-123.000">
                                            @error('npwp_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="siup_number" class="form-label">SIUP Number</label>
                                            <input type="text" name="siup_number" id="siup_number" class="form-control @error('siup_number') is-invalid @enderror"
                                                   value="{{ old('siup_number', $settings->siup_number) }}">
                                            @error('siup_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="tdp_number" class="form-label">TDP Number</label>
                                            <input type="text" name="tdp_number" id="tdp_number" class="form-control @error('tdp_number') is-invalid @enderror"
                                                   value="{{ old('tdp_number', $settings->tdp_number) }}">
                                            @error('tdp_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="establishment_date" class="form-label">Establishment Date</label>
                                            <input type="date" name="establishment_date" id="establishment_date" class="form-control @error('establishment_date') is-invalid @enderror"
                                                   value="{{ old('establishment_date', $settings->establishment_date ? $settings->establishment_date->format('Y-m-d') : '') }}">
                                            @error('establishment_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="legal_entity_type" class="form-label">Legal Entity Type</label>
                                            <select name="legal_entity_type" id="legal_entity_type" class="form-select @error('legal_entity_type') is-invalid @enderror">
                                                <option value="">Select Legal Entity Type</option>
                                                <option value="PT" {{ old('legal_entity_type', $settings->legal_entity_type) == 'PT' ? 'selected' : '' }}>PT (Perseroan Terbatas)</option>
                                                <option value="CV" {{ old('legal_entity_type', $settings->legal_entity_type) == 'CV' ? 'selected' : '' }}>CV (Commanditaire Vennootschap)</option>
                                                <option value="UD" {{ old('legal_entity_type', $settings->legal_entity_type) == 'UD' ? 'selected' : '' }}>UD (Usaha Dagang)</option>
                                                <option value="Firma" {{ old('legal_entity_type', $settings->legal_entity_type) == 'Firma' ? 'selected' : '' }}>Firma</option>
                                                <option value="Koperasi" {{ old('legal_entity_type', $settings->legal_entity_type) == 'Koperasi' ? 'selected' : '' }}>Koperasi</option>
                                                <option value="Yayasan" {{ old('legal_entity_type', $settings->legal_entity_type) == 'Yayasan' ? 'selected' : '' }}>Yayasan</option>
                                                <option value="Perorangan" {{ old('legal_entity_type', $settings->legal_entity_type) == 'Perorangan' ? 'selected' : '' }}>Perorangan</option>
                                            </select>
                                            @error('legal_entity_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Person -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-secondary">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="cil-user me-2 text-secondary"></i>Contact Person
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="contact_person_name" class="form-label">Contact Person Name</label>
                                            <input type="text" name="contact_person_name" id="contact_person_name" class="form-control @error('contact_person_name') is-invalid @enderror"
                                                   value="{{ old('contact_person_name', $settings->contact_person_name) }}">
                                            @error('contact_person_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="contact_person_position" class="form-label">Position</label>
                                            <input type="text" name="contact_person_position" id="contact_person_position" class="form-control @error('contact_person_position') is-invalid @enderror"
                                                   value="{{ old('contact_person_position', $settings->contact_person_position) }}"
                                                   placeholder="e.g., HR Manager">
                                            @error('contact_person_position')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="contact_person_phone" class="form-label">Contact Person Phone</label>
                                            <input type="text" name="contact_person_phone" id="contact_person_phone" class="form-control @error('contact_person_phone') is-invalid @enderror"
                                                   value="{{ old('contact_person_phone', $settings->contact_person_phone) }}">
                                            @error('contact_person_phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="contact_person_email" class="form-label">Contact Person Email</label>
                                            <input type="email" name="contact_person_email" id="contact_person_email" class="form-control @error('contact_person_email') is-invalid @enderror"
                                                   value="{{ old('contact_person_email', $settings->contact_person_email) }}">
                                            @error('contact_person_email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Banking Information -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-danger">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="cil-bank me-2 text-danger"></i>Banking Information
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="bank_name" class="form-label">Bank Name</label>
                                            <input type="text" name="bank_name" id="bank_name" class="form-control @error('bank_name') is-invalid @enderror"
                                                   value="{{ old('bank_name', $settings->bank_name) }}"
                                                   placeholder="e.g., Bank Central Asia">
                                            @error('bank_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="bank_account_number" class="form-label">Account Number</label>
                                            <input type="text" name="bank_account_number" id="bank_account_number" class="form-control @error('bank_account_number') is-invalid @enderror"
                                                   value="{{ old('bank_account_number', $settings->bank_account_number) }}">
                                            @error('bank_account_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="bank_account_holder" class="form-label">Account Holder</label>
                                            <input type="text" name="bank_account_holder" id="bank_account_holder" class="form-control @error('bank_account_holder') is-invalid @enderror"
                                                   value="{{ old('bank_account_holder', $settings->bank_account_holder) }}">
                                            @error('bank_account_holder')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-primary">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="cil-share me-2 text-primary"></i>Social Media
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="facebook_url" class="form-label">Facebook URL</label>
                                            <input type="url" name="facebook_url" id="facebook_url" class="form-control @error('facebook_url') is-invalid @enderror"
                                                   value="{{ old('facebook_url', $settings->facebook_url) }}"
                                                   placeholder="https://facebook.com/yourcompany">
                                            @error('facebook_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="instagram_url" class="form-label">Instagram URL</label>
                                            <input type="url" name="instagram_url" id="instagram_url" class="form-control @error('instagram_url') is-invalid @enderror"
                                                   value="{{ old('instagram_url', $settings->instagram_url) }}"
                                                   placeholder="https://instagram.com/yourcompany">
                                            @error('instagram_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="linkedin_url" class="form-label">LinkedIn URL</label>
                                            <input type="url" name="linkedin_url" id="linkedin_url" class="form-control @error('linkedin_url') is-invalid @enderror"
                                                   value="{{ old('linkedin_url', $settings->linkedin_url) }}"
                                                   placeholder="https://linkedin.com/company/yourcompany">
                                            @error('linkedin_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="twitter_url" class="form-label">Twitter URL</label>
                                            <input type="url" name="twitter_url" id="twitter_url" class="form-control @error('twitter_url') is-invalid @enderror"
                                                   value="{{ old('twitter_url', $settings->twitter_url) }}"
                                                   placeholder="https://twitter.com/yourcompany">
                                            @error('twitter_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business Hours & Settings -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-success">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="cil-clock me-2 text-success"></i>Business Hours & Settings
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="business_hours" class="form-label">Business Hours</label>
                                            <textarea name="business_hours" id="business_hours" class="form-control @error('business_hours') is-invalid @enderror"
                                                      rows="3" placeholder="e.g., Monday-Friday: 08:00-17:00">{{ old('business_hours', $settings->business_hours) }}</textarea>
                                            @error('business_hours')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="timezone" class="form-label">Timezone <span class="text-danger">*</span></label>
                                            <select name="timezone" id="timezone" class="form-select @error('timezone') is-invalid @enderror" required>
                                                <option value="">Select Timezone</option>
                                                <option value="Asia/Jakarta" {{ old('timezone', $settings->timezone ?? 'Asia/Jakarta') == 'Asia/Jakarta' ? 'selected' : '' }}>Asia/Jakarta (WIB)</option>
                                                <option value="Asia/Makassar" {{ old('timezone', $settings->timezone) == 'Asia/Makassar' ? 'selected' : '' }}>Asia/Makassar (WITA)</option>
                                                <option value="Asia/Jayapura" {{ old('timezone', $settings->timezone) == 'Asia/Jayapura' ? 'selected' : '' }}>Asia/Jayapura (WIT)</option>
                                                <option value="UTC" {{ old('timezone', $settings->timezone) == 'UTC' ? 'selected' : '' }}>UTC</option>
                                            </select>
                                            @error('timezone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input"
                                               value="1" {{ old('is_active', $settings->is_active ?? true) ? 'checked' : '' }}>
                                        <label for="is_active" class="form-check-label">
                                            Company is active
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                <i class="cil-arrow-left me-1"></i> Back to Dashboard
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="cil-save me-1"></i> Save Settings
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // File preview for logo
    $('#company_logo').on('change', function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#logo-preview').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        }
    });

    // File preview for favicon
    $('#company_favicon').on('change', function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#favicon-preview').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        }
    });

    // Auto-format phone numbers
    $('#company_phone, #contact_person_phone').on('input', function() {
        var value = $(this).val().replace(/\D/g, '');
        if (value.length > 0) {
            if (value.startsWith('62')) {
                // Indonesian format
                $(this).val(value.replace(/(\d{2})(\d{3})(\d{4})(\d{4})/, '+$1 $2-$3-$4'));
            } else if (value.startsWith('0')) {
                // Local format
                $(this).val(value.replace(/(\d{3})(\d{4})(\d{4})/, '$1-$2-$3'));
            }
        }
    });

    // NPWP formatting
    $('#npwp_number').on('input', function() {
        var value = $(this).val().replace(/\D/g, '');
        if (value.length <= 15) {
            $(this).val(value.replace(/(\d{2})(\d{3})(\d{3})(\d{1})(\d{3})(\d{3})/, '$1.$2.$3.$4-$5.$6'));
        }
    });
});
</script>
@endpush
