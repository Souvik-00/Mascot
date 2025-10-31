<x-layout>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Student Finance Report (as of {{ now()->format('d M Y') }})</h4>
        </div>

        {{-- 🔍 Search Bar --}}
        <form method="GET" action="{{ route('student_finance.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control"
                       placeholder="Search by student name..."
                       value="{{ $search ?? '' }}">
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-search"></i> Search
                </button>
                @if(!empty($search))
                    <a href="{{ route('student_finance.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x"></i> Clear
                    </a>
                @endif
            </div>
        </form>

        {{-- Finance Report Table --}}
        <div class="card shadow-sm">
            <div class="card-body">
                @if ($report->count())
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Student</th>
                                <th>Course</th>
                                <th>Total Fee (₹)</th>
                                <th>Paid (₹)</th>
                                <th>Pending (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($report as $r)
                                <tr>
                                    <td>{{ $r->student_name }}</td>
                                    <td>{{ $r->course_name }}</td>
                                    <td>₹{{ number_format($r->course_fee, 2) }}</td>
                                    <td>₹{{ number_format($r->total_paid, 2) }}</td>
                                    <td>
                                        @if($r->pending_amount > 0)
                                            <span class="badge bg-danger">₹{{ number_format($r->pending_amount, 2) }}</span>
                                        @else
                                            <span class="badge bg-success">Paid</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted mb-0">No records found.</p>
                @endif
            </div>
        </div>
    </div>
</x-layout>
