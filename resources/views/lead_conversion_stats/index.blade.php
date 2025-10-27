<x-layout title="Lead Conversion Stats">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">📊 Lead Conversion Stats</h4>
        <a href="{{ route('lead_conversion_stats.create') }}" class="btn btn-primary">
            ➕ Add New Record
        </a>
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
                        <th>Lead Name</th>
                        <th>Date</th>
                        <th>Pipeline Stage</th>
                        <th>Comments</th>
                        <th class="text-center" width="160">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($stats as $index => $stat)
                        <tr>
                            {{-- Show correct numbering with pagination --}}
                            <td>{{ $index + $stats->firstItem() }}</td>
                            <td><span class="fw-semibold">{{ $stat->lead->name ?? 'N/A' }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($stat->date)->format('d M Y') }}</td>
                            <td>{{ $stat->pipelineStage->crm_pipeline_stages ?? 'N/A' }}</td>
                            <td>{{ Str::limit($stat->comments, 50) }}</td>

                            <td class="text-center">
                                <a href="{{ route('lead_conversion_stats.edit', $stat->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="{{ route('leads_trial.create', $stat->lead->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-plus-circle"></i>
                                </a>
                                <form action="{{ route('lead_conversion_stats.destroy', $stat->id) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Delete this record?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">No conversion stats found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $stats->links() }}
            </div>
        </div>
    </div>

</x-layout>
