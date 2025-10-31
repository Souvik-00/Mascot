<x-layout>
    <div class="container mt-4">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">Expense Report (Category-wise)</h4>
            <a href="{{ route('expenses.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        {{-- Table --}}
        <div class="card shadow-sm">
            <div class="card-body">
                @if ($reports->count())
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Date</th>
                                <th class="text-end">Cost (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $item)
                                <tr>
                                    <td>{{ $item->category_name }}</td>
                                    <td>{{ $item->sub_category_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->expense_date)->format('d M Y') }}</td>
                                    <td class="text-end fw-semibold">{{ number_format($item->amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted mb-0">No expense records found.</p>
                @endif
            </div>
        </div>
    </div>
</x-layout>
