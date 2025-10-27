<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">🔍 Search Batches</h4>
        <a href="{{ route('batches.index') }}" class="btn btn-secondary">← Back</a>
    </div>

    <form method="GET" action="{{ route('batches.search') }}" class="card p-3 mb-4 shadow-sm">
        <div class="row">
            <div class="col-md-5 mb-2">
                <input type="text" name="search" class="form-control"
                       placeholder="Search by code or title" value="{{ request('search') }}">
            </div>
            <div class="col-md-4 mb-2">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    @foreach(['planned','running','completed','cancelled'] as $status)
                        <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-2">
                <button class="btn btn-primary w-100">Search</button>
            </div>
        </div>
    </form>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Batch Code</th>
                        <th>Course</th>
                        <th>Title</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($batches as $index => $batch)
                        <tr>
                            <td>{{ $index + $batches->firstItem() }}</td>
                            <td>{{ $batch->batch_code }}</td>
                            <td>{{ $batch->course->title ?? '—' }}</td>
                            <td>{{ $batch->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($batch->start_date)->format('d M Y') }}</td>
                            <td>{{ $batch->end_date ? \Carbon\Carbon::parse($batch->end_date)->format('d M Y') : '—' }}</td>
                            <td>
                                <span class="badge bg-{{ $colors[$batch->status] ?? 'secondary' }}">
                                    {{ ucfirst($batch->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-3">No batches found.</td></tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $batches->links() }}
            </div>
        </div>
    </div>
</x-layout>
