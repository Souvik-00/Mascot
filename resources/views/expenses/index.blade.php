<x-layout>
    <div class="container mt-4">
        <h4 class="fw-bold mb-3">Expense Records</h4>

        {{-- 🔍 Search / Filter --}}
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

        {{-- ✅ Success message --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- ➕ Add New Expense --}}
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('expenses.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Add Expense
            </a>
        </div>

        {{-- 📋 Table --}}
        <div class="card shadow-sm">
            <div class="card-body">
                @if($expenses->count())
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Batch</th>
                                <th>Category</th>
                                <th>Amount (₹)</th>
                                <th>Payment Method</th>
                                <th>Notes</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($expenses as $item)
                                <tr>
                                    <td>{{ $item->expense_date }}</td>
                                    <td>{{ $item->batch->title ?? '—' }}</td>
                                    <td>{{ $item->category }}</td>
                                    <td>{{ number_format($item->amount, 2) }}</td>
                                    <td>{{ $item->payment_method ?? '—' }}</td>
                                    <td>{{ $item->notes ?? '—' }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('expenses.edit', $item->id) }}" class="btn btn-sm btn-warning me-1">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('expenses.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete this expense?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Pagination --}}
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
