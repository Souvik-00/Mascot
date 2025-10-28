<x-layout>
    <div class="container mt-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Edit Lead Attendance</h4>
            <a href="{{ route('lead_attendance.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        {{-- Filter Form --}}
        <form method="GET" action="{{ route('lead_attendance.edit') }}" class="row g-3 mb-3">
            <div class="col-md-4">
                <label class="form-label">Select Batch</label>
                <select name="batch_id" class="form-select" required>
                    <option value="">-- Select Batch --</option>
                    @foreach($batches as $batch)
                        <option value="{{ $batch->id }}" {{ request('batch_id') == $batch->id ? 'selected' : '' }}>
                            {{ $batch->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Select Date</label>
                <input type="date" name="attendance_date" class="form-control" 
                       value="{{ request('attendance_date') }}" required>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Load Attendance
                </button>
            </div>
        </form>

        {{-- Attendance Form --}}
        @if(request('batch_id') && request('attendance_date'))
            <form action="{{ route('lead_attendance.update') }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="batch_id" value="{{ request('batch_id') }}">
                <input type="hidden" name="attendance_date" value="{{ request('attendance_date') }}">

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">Date: {{ request('attendance_date') }}</h6>

                        @if($attendanceRecords->count())
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Lead Name</th>
                                        <th>Present</th>
                                        <th>Absent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($attendanceRecords as $record)
                                        <tr>
                                            <td>{{ $record->lead->name ?? '—' }}</td>
                                            <td>
                                                <input type="radio" 
                                                       name="attendance[{{ $record->lead_id }}]" 
                                                       value="1"
                                                       {{ $record->is_present ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <input type="radio" 
                                                       name="attendance[{{ $record->lead_id }}]" 
                                                       value="0"
                                                       {{ !$record->is_present ? 'checked' : '' }}>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted mb-0">No leads found for this batch.</p>
                        @endif
                    </div>
                </div>

                @if($attendanceRecords->count())
                    <button type="submit" class="btn btn-success mt-3">
                        <i class="bi bi-save"></i> Update Attendance
                    </button>
                @endif
            </form>
        @endif

    </div>
</x-layout>
