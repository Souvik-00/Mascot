<x-layout>
    <div class="container mt-4">
        <h4 class="fw-bold mb-3">Lead Attendance Records</h4>

        {{-- Search Filter --}}
    <form method="GET" class="row g-3 mb-3">
        <div class="col-md-3">
            <label class="form-label">Batch</label>
            <select name="batch_id" class="form-select">
            <option value="">-- All Batches --</option>
            @foreach($batches as $batch)
                <option value="{{ $batch->id }}" {{ request('batch_id') == $batch->id ? 'selected' : '' }}>
                    {{ $batch->title }}
                </option>
            @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label">From Date</label>
            <input type="date" name="from_date" value="{{ request('from_date') }}" class="form-control">
        </div>

        <div class="col-md-3">
            <label class="form-label">To Date</label>
            <input type="date" name="to_date" value="{{ request('to_date') }}" class="form-control">
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <button class="btn btn-primary w-100">
            <i class="bi bi-search"></i> Search
            </button>
        </div>
    </form>
        <div class="card shadow-sm">
            <div class="card-body">
                @if ($attendances->count())
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Batch</th>
                                <th>Lead</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $item)
                                <tr>
                                    <td>{{ $item->attendance_date }}</td>
                                    <td>{{ $item->batch->title ?? '—' }}</td>
                                    <td>{{ $item->lead->name ?? '—' }}</td>
                                    <td>
                                        @if($item->is_present)
                                            <span class="badge bg-success">Present</span>
                                        @else
                                            <span class="badge bg-danger">Absent</span>
                                        @endif
                                    </td>
                                    <td>
                                    <a href="{{ route('lead_attendance.edit', ['batch_id' => $item->batch_id, 'attendance_date' => $item->attendance_date]) }}" 
                                        class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted mb-0">No attendance records found.</p>
                @endif
            </div>
        </div>
    </div>
</x-layout>
