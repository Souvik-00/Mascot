<x-layout>
    <div class="container mt-4">
        <h4 class="fw-bold mb-3">Finance Reports — Department-wise Payments</h4>

        <!-- 🔍 Filter Section -->
        <form method="GET" class="row g-3 mb-4">
            <div class="col-md-3">
                <select name="department_name" class="form-select">
                    <option value="">-- All Departments --</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->dept_name }}" 
                            {{ request('department_name') == $dept->dept_name ? 'selected' : '' }}>
                            {{ $dept->dept_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <input type="date" name="from_date" 
                    value="{{ request('from_date', $fromDate) }}" 
                    class="form-control" placeholder="From Date">
            </div>

            <div class="col-md-3">
                <input type="date" name="to_date" 
                    value="{{ request('to_date', $toDate) }}" 
                    class="form-control" placeholder="To Date">
            </div>

            <div class="col-md-3">
                <button class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Filter
                </button>
            </div>
        </form>

        <!-- 💳 Finance Table -->
        <div class="card shadow-sm">
            <div class="card-body">
                @if($payments->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Course</th>
                                    <th>Batch</th>
                                    <th>Student</th>
                                    <th>Amount (₹)</th>
                                    <th>Payment Date</th>
                                    <th>Method</th>
                                    <th>Transaction ID</th>
                                    <th>Total (₹)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $p)
                                    <tr>
                                        <td>{{ $p->course }}</td>
                                        <td>{{ $p->batch }}</td>
                                        <td>{{ $p->student_name }}</td>
                                        <td>{{ number_format($p->amount, 2) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($p->payment_date)->format('d-M-Y') }}</td>
                                        <td>{{ $p->payment_method ?? '-' }}</td>
                                        <td>{{ $p->transaction_id ?? '-' }}</td>
                                        <td class="fw-bold text-success">{{ number_format($p->total_payment_received, 2) }}</td>
                                    </tr>
                                @endforeach
                                <tr class="table-primary fw-bold">
                                    <td colspan="7" class="text-end">Grand Total:</td>
                                    <td>₹{{ number_format($grandTotal, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center mb-0">
                        No payment records found for the selected filters.
                    </p>
                @endif
            </div>
        </div>
    </div>
</x-layout>
    