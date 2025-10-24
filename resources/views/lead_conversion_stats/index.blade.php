<x-layout title="Lead Conversion Stats">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>📊 Lead Conversion Stats</h3>
        <a href="{{ route('lead_conversion_stats.create') }}" class="btn btn-primary">
            ➕ Add New Record
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Conversion Stats Table --}}
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Lead Name</th>
                    <th>Date</th>
                    <th>Pipeline Stage</th>
                    <th>Comments</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($stats as $stat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $stat->lead->name ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($stat->date)->format('d M Y') }}</td>
                        <td>{{ $stat->pipelineStage->crm_pipeline_stages ?? 'N/A' }}</td>
                        <td>{{ Str::limit($stat->comments, 50) }}</td>
                        <td class="text-end">
                            {{-- <a href="{{ route('lead_conversion_stats.show', $stat->id) }}" class="btn btn-sm btn-outline-info">👁️ View</a> --}}
                            <a href="{{ route('lead_conversion_stats.edit', $stat->id) }}" class="btn btn-sm btn-outline-warning">✏️ Edit</a>
                            <form action="{{ route('lead_conversion_stats.destroy', $stat->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit" 
                                    class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Delete this record?')">
                                    🗑️ Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            No conversion stats found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $stats->links() }}
    </div>
</x-layout>
