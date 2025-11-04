@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Apply for Leave</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('leave-applications.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="leave_type_id" class="form-label">Leave Type <span class="text-danger">*</span></label>
                                    <select class="form-select @error('leave_type_id') is-invalid @enderror" id="leave_type_id" name="leave_type_id" required>
                                        <option value="">Select Leave Type</option>
                                        @foreach($leaveTypes as $leaveType)
                                            <option value="{{ $leaveType->id }}" {{ old('leave_type_id') == $leaveType->id ? 'selected' : '' }}>
                                                {{ $leaveType->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('leave_type_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date"
                                           value="{{ old('start_date') }}" min="{{ date('Y-m-d') }}" required>
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date"
                                           value="{{ old('end_date') }}" min="{{ date('Y-m-d') }}" required>
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Total Days</label>
                                    <input type="text" class="form-control" id="total_days" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="reason" class="form-label">Reason <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('reason') is-invalid @enderror" id="reason" name="reason" rows="3"
                                      placeholder="Please provide a detailed reason for your leave application" required>{{ old('reason') }}</textarea>
                            @error('reason')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Additional Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="2"
                                      placeholder="Any additional information or special requests">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('leave-applications.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit Application</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Leave Balance</h5>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <h2 class="text-primary">{{ $currentBalance }}</h2>
                        <p class="text-muted mb-0">Days Remaining</p>
                        <small class="text-muted">For {{ date('F Y') }}</small>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="card-title">Important Notes</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-info-circle text-info me-2"></i>Leave applications must be submitted at least 7 days in advance</li>
                        <li class="mb-2"><i class="fas fa-calendar text-warning me-2"></i>You receive 1 day of leave per month</li>
                        <li class="mb-2"><i class="fas fa-clock text-success me-2"></i>Applications are subject to approval by management</li>
                        <li class="mb-0"><i class="fas fa-ban text-danger me-2"></i>Cannot apply for overlapping leave periods</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Calculate total days when dates change
function calculateTotalDays() {
    const startDate = new Date($('#start_date').val());
    const endDate = new Date($('#end_date').val());

    if (startDate && endDate && endDate >= startDate) {
        const timeDiff = endDate.getTime() - startDate.getTime();
        const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1;
        $('#total_days').val(daysDiff + ' days');
    } else {
        $('#total_days').val('');
    }
}

$(document).ready(function() {
    $('#start_date, #end_date').on('change', calculateTotalDays);

    // Set minimum end date to start date
    $('#start_date').on('change', function() {
        $('#end_date').attr('min', $(this).val());
    });
});
</script>
@endpush
