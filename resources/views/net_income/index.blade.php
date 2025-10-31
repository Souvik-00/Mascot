<x-layout>
    <div class="container mt-4">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold text-primary mb-0">
                <i class="bi bi-graph-up-arrow"></i> Department-wise Net Income Report
            </h4>
        </div>

        {{-- 🔍 Date Range Filter --}}
        <form method="GET" class="row g-3 mb-3">
            <div class="col-md-4">
                <label class="form-label">From Date</label>
                <input type="date" name="from_date" value="{{ $fromDate }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">To Date</label>
                <input type="date" name="to_date" value="{{ $toDate }}" class="form-control">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Filter
                </button>
            </div>
        </form>

        {{-- Results --}}
        @if($results)
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-bordered align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Department</th>
                                <th class="text-end">Total Payment (₹)</th>
                                <th class="text-end">Total Expense (₹)</th>
                                <th class="text-end">Net Income (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $row)
                                <tr>
                                    <td>{{ $row['department'] }}</td>
                                    <td class="text-end text-success fw-semibold">{{ number_format($row['total_payment'], 2) }}</td>
                                    <td class="text-end text-danger fw-semibold">{{ number_format($row['total_expense'], 2) }}</td>
                                    <td class="text-end fw-bold {{ $row['net_income'] >= 0 ? 'text-success' : 'text-danger' }}">
                                        ₹{{ number_format($row['net_income'], 2) }}
                                    </td>
                                </tr>
                            @endforeach

                            {{-- Grand Totals --}}
                            <tr class="table-secondary fw-bold">
                                <td class="text-end">Grand Total:</td>
                                <td class="text-end text-success">₹{{ number_format($grandTotal['grand_payment'], 2) }}</td>
                                <td class="text-end text-danger">₹{{ number_format($grandTotal['grand_expense'], 2) }}</td>
                                <td class="text-end text-primary">₹{{ number_format($grandTotal['grand_net'], 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-info text-center mt-3">
                <i class="bi bi-info-circle"></i> No records found for this date range.
            </div>
        @endif
    </div>
</x-layout>
