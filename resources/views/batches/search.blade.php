<x-layout title="Search Batches">
    <h3 class="mb-4">🔍 Search Batches</h3>

    <form method="GET" action="{{ route('batches.search') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="query" class="form-control"
                   placeholder="Search by batch code, title, or organisation..."
                   value="{{ $query ?? '' }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    @if ($batches->count())
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Batch Code</th>
                        <th>Title</th>
                        <th>Organisation</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($batches as $batch)
                        <tr>
                            <td>{{ $batch->batch_code }}</td>
                            <td>{{ $batch->title }}</td>
                            <td>{{ $batch->organisation?->name ?? '—' }}</td>
                            <td>{{ $batch->start_date }}</td>
                            <td>{{ $batch->end_date ?? '—' }}</td>
                            <td>{{ $batch->capacity ?? '—' }}</td>
                            <td>
                                <span class="badge bg-{{ 
                                    $batch->status == 'running' ? 'success' : 
                                    ($batch->status == 'planned' ? 'info' : 
                                    ($batch->status == 'completed' ? 'secondary' : 'danger')) 
                                }}">
                                    {{ ucfirst($batch->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('batches.edit', $batch->id) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                                <form method="POST" action="{{ route('batches.destroy', $batch->id) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this batch?')">🗑️ Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $batches->links() }}
        </div>
    @else
        <p class="text-muted">No batches found. Try a different keyword.</p>
    @endif
</x-layout>
