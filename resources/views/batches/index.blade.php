<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Batch Directory</h3>
        <a href="{{ route('batches.create') }}" class="btn btn-primary">➕ Add Batch</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle table-sm">
            <thead class="table-dark">
                <tr>
                    <th>Organisation</th>
                    <th>Code</th>
                    <th>Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Capacity</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($batches as $batch)
                    <tr>
                        <td>{{ $batch->organisation?->name ?? '-' }}</td>
                        <td>{{ $batch->batch_code }}</td>
                        <td>{{ $batch->title }}</td>
                        <td>{{ $batch->start_date }}</td>
                        <td>{{ $batch->end_date ?? '-' }}</td>
                        <td>{{ $batch->capacity ?? '-' }}</td>
                        <td>
                            <span class="badge bg-{{ $batch->status == 'running' ? 'info' : ($batch->status == 'completed' ? 'success' : ($batch->status == 'cancelled' ? 'danger' : 'secondary')) }}">
                                {{ ucfirst($batch->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('batches.edit', $batch->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('batches.destroy', $batch->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this batch?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center">No batches found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layout>
