<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">🗂️ Attendance History</h4>
        <a href="{{ route('leads_attendance.mark') }}" class="btn btn-primary">➕ Mark Today</a>
    </div>

    {{-- Filter: From/To --}}
    <form method="GET" action="{{ route('leads_attendance.index') }}" class="card p-3 shadow-sm border-0 mb-3">
        <div class="row g-2">
            <div class="col-md-4">
                <label class="form-label fw-semibold">From Date</label>
                <input type="date" name="from_date" value="{{ $from }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">To Date</label>
                <input type="date" name="to_date" value="{{ $to }}" class="form-control">
            </div>
            <div class="col-md-4 d-flex align-items-end gap-2">
                <button class="btn btn-primary w-100">🔍 Search</button>
                @if($from || $to)
                    <a href="{{ route('leads_attendance.index') }}" class="btn btn-secondary w-100">❌ Clear</a>
                @endif
            </div>
        </div>
    </form>

    <div class="card shadow-sm border-0">
        <div class="card-body table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
                <tr>
                    <th style="width:60px">#</th>
                    <th>Date</th>
                    <th>Lead</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @forelse($records as $i => $rec)
                    <tr>
                        <td>{{ $records->firstItem() + $i }}</td>
                        <td>{{ \Carbon\Carbon::parse($rec->attn_date)->format('d M Y') }}</td>
                        <td>{{ $rec->lead->name ?? '—' }}</td>
                        <td>
                            @if($rec->status === 'present')
                                <span class="badge bg-success">Present</span>
                            @else
                                <span class="badge bg-danger">Absent</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-3">No records found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $records->appends(request()->only('from_date', 'to_date'))->links() }}
            </div>
        </div>
    </div>
</x-layout>
