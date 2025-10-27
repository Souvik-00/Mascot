<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">📦 Batch Directory</h4>
        <a href="{{ route('batches.create') }}" class="btn btn-primary">➕ Add New Batch</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Batch Code</th>
                        <th>Course</th>
                        <th>Title</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th class="text-center" width="160">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($batches as $index => $batch)
                        <tr>
                            <td>{{ $index + $batches->firstItem() }}</td>
                            <td><span class="fw-semibold">{{ $batch->batch_code }}</span></td>
                            <td>{{ $batch->course->title ?? '—' }}</td>
                            <td>{{ $batch->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($batch->start_date)->format('d M Y') }}</td>
                            <td>{{ $batch->end_date ? \Carbon\Carbon::parse($batch->end_date)->format('d M Y') : '—' }}</td>
                            <td>{{ $batch->capacity ?? '—' }}</td>
                            <td>
                                @php
                                    $colors = ['planned'=>'secondary','running'=>'info','completed'=>'success','cancelled'=>'danger'];
                                @endphp
                                <span class="badge bg-{{ $colors[$batch->status] ?? 'secondary' }}">
                                    {{ ucfirst($batch->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('batches.edit', $batch->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('batches.destroy', $batch->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Delete this batch?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center text-muted py-3">No batches found.</td></tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $batches->links() }}
            </div>
        </div>
    </div>
</x-layout>
