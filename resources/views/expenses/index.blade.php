<x-layout>
    <div class="container mt-4">
        {{-- 🧾 Header --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">Expense Records</h4>
            <a href="{{ route('expenses.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add Expense
            </a>
        </div>

        {{-- 🔍 Filters --}}
        <form method="GET" class="row g-3 mb-3">
            <div class="col-md-3">
                <label class="form-label">Batch</label>
                <select name="batch_id" class="form-select">
                    <option value="">-- All Batches --</option>
                    @foreach ($batches as $batch)
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
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Search
                </button>
            </div>
        </form>

        {{-- ⚡ Flash Messages --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- 📊 Expense Table --}}
        <div class="card shadow-sm">
            <div class="card-body">
                @if ($expenses->count())
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light text-center">
                                <tr>
                                    <th style="width: 8%">Date</th>
                                    <th style="width: 10%">Batch</th>
                                    <th style="width: 15%">Category</th>
                                    <th style="width: 15%">Subcategory</th>
                                    <th style="width: 10%" class="text-end">Amount (₹)</th>
                                    <th style="width: 10%">Payment Method</th>
                                    <th style="width: 20%">Notes</th>
                                    <th style="width: 12%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expenses as $item)
                                    <tr>
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($item->expense_date)->format('d M Y') }}
                                        </td>
                                        <td>{{ $item->batch->title ?? '—' }}</td>
                                        <td>{{ $item->subcategory?->category?->category_name ?? '—' }}</td>
                                        <td>{{ $item->subcategory?->sub_category_name ?? '—' }}</td>
                                        <td class="text-end fw-semibold">{{ number_format($item->amount, 2) }}</td>
                                        <td>{{ $item->payment_method ?? '—' }}</td>
                                        <td>{{ $item->notes ?? '—' }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-1">
                                                {{-- Edit --}}
                                                <a href="{{ route('expenses.edit', $item->id) }}"
                                                   class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                {{-- Delete --}}
                                                <form action="{{ route('expenses.destroy', $item->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Are you sure you want to delete this expense?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- 📄 Pagination --}}
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
