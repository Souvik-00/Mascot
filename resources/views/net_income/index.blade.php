<x-layout>
    <div class="container mt-4">

        {{-- Header --}}
        <div class="text-center mb-4">
            <h4 class="fw-bold text-primary mb-0">
                <i class="bi bi-cash-coin"></i> Department-wise Net Income Report
            </h4>
        </div>

        {{-- 🔍 Date Range Filter --}}
        <form method="GET" class="row g-3 mb-4 justify-content-center">
            <div class="col-md-3">
                <label class="form-label fw-semibold">From Date</label>
                <input type="date" name="from_date" value="{{ request('from_date', $fromDate) }}" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">To Date</label>
                <input type="date" name="to_date" value="{{ request('to_date', $toDate) }}" class="form-control">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Search
                </button>
            </div>
        </form>

        {{-- 📊 Departmentwise Payments --}}
        @if(count($results) > 0)
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-bordered text-center align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Department</th>
                                <th>Total Payment (₹)</th>
                                <th>Total Expense (₹)</th>
                                <th>Net Income (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $row)
                                <tr>
                                    <td class="text-start fw-semibold">{{ $row['department'] }}</td>
                                    <td>{{ number_format($row['total_payment'], 2) }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach

                            {{-- ✅ Grand Total Row --}}
                            <tr class="table-secondary fw-bold">
                                <td class="text-start">Grand Total</td>
                                <td>{{ number_format($grandPayment, 2) }}</td>
                                <td>{{ number_format($totalExpense, 2) }}</td>
                                <td class="{{ $netIncome >= 0 ? 'text-success' : 'text-danger' }}">
                                    {{ number_format($netIncome, 2) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-info text-center mt-4">
                <i class="bi bi-info-circle"></i> No records found for this date range.
            </div>
        @endif
    </div>
</x-layout>
