<x-layout>
    <div class="container mt-4">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">Expense Records</h4>
            <a href="{{ route('expenses.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add Expense
            </a>
        </div>

        {{-- Date Filter --}}
        <form method="GET" class="row g-3 mb-3">
            <div class="col-md-4">
                <label class="form-label">From Date</label>
                <input type="date" name="from_date" value="{{ request('from_date') }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">To Date</label>
                <input type="date" name="to_date" value="{{ request('to_date') }}" class="form-control">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Filter
                </button>
            </div>
        </form>

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Table --}}
        <div class="card shadow-sm">
            <div class="card-body">
                @if ($expenses->count())
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th class="text-end">Amount (₹)</th>
                                <th>Payment Method</th>
                                <th>Notes</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expenses as $item)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->expense_date)->format('d M Y') }}</td>
                                    <td>{{ $item->subcategory?->category?->category_name ?? '—' }}</td>
                                    <td>{{ $item->subcategory?->sub_category_name ?? '—' }}</td>
                                    <td class="text-end fw-semibold text-success">
                                        ₹{{ number_format($item->amount, 2) }}
                                    </td>
                                    <td>{{ $item->payment_method ?? '—' }}</td>
                                    <td>{{ $item->notes ?? '—' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('expenses.edit', $item->id) }}" class="btn btn-sm btn-warning me-1">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('expenses.destroy', $item->id) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this expense?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            {{-- Pagination --}}
                            <tr class="table-secondary fw-bold">
                                <td colspan="3" class="text-end">Total:</td>
                                <td class="text-end text-primary fw-bold">
                                    ₹{{ number_format($expenses->sum('amount'), 2) }}
                                </td>
                                <td colspan="3"></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $expenses->links() }}
                    </div>
                @else
                    <p class="text-muted mb-0">No expense records found.</p>
                @endif
            </div>
        </div>
    </div>
</x-layout>
