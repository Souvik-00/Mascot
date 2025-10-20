<x-layout title="CRM Pipeline Stages">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>🏗️ CRM Pipeline Stages</h3>
        <a href="{{ route('crm_pipeline_stages.create') }}" class="btn btn-primary">
            ➕ Add New Stage
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Stage Name</th>
                    <th>What It Means</th>
                    <th>Enter When</th>
                    <th>Exit When</th>
                    <th>Owner</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stages as $stage)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $stage->crm_pipeline_stages }}</td>
                        <td>{{ Str::limit($stage->what_it_means, 50) }}</td>
                        <td>{{ Str::limit($stage->enter_when, 50) }}</td>
                        <td>{{ Str::limit($stage->exit_when, 50) }}</td>
                        <td>{{ $stage->owner }}</td>
                        <td class="text-end">
                            {{-- <a href="{{ route('crm_pipeline_stages.show', $stage->id) }}" class="btn btn-sm btn-outline-info">👁️ View</a> --}}
                            <a href="{{ route('crm_pipeline_stages.edit', $stage->id) }}" class="btn btn-sm btn-outline-warning">✏️ Edit</a>
                            <form action="{{ route('crm_pipeline_stages.destroy', $stage->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Delete this stage?')">🗑️ Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            No pipeline stages found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $stages->links() }}
    </div>
</x-layout>
