<x-layout>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">
                Payment History – {{ $studentName }}
            </h4>
            <a href="{{ route('student_finance.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Course</th>
                            <th>Batch</th>
                            <th>Amount (₹)</th>
                            <th>Payment Method</th>
                            <th>Transaction ID</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($studentPayments as $p)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($p->payment_date)->format('d M Y') }}</td>
                                <td>{{ $p->course_name }}</td>
                                <td>{{ $p->batch_name }}</td>
                                <td class="text-end fw-semibold text-success">₹{{ number_format($p->amount, 2) }}</td>
                                <td>{{ $p->payment_method ?? '—' }}</td>
                                <td>{{ $p->transaction_id ?? '—' }}</td>
                                <td>{{ $p->notes ?? '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
