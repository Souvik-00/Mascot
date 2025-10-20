<x-layout title="Marketing Sources">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>📢 Marketing Sources</h3>
        <a href="{{ route('marketing_sources.create') }}" class="btn btn-primary">
            ➕ Add New Source
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
                    <th>Lead Source</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sources as $source)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $source->lead_source }}</td>
                        <td class="text-end">
                            <a href="{{ route('marketing_sources.edit', $source->id) }}" 
                               class="btn btn-sm btn-outline-warning">✏️ Edit</a>

                            <form action="{{ route('marketing_sources.destroy', $source->id) }}" 
                                  method="POST" 
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Delete this source?')">
                                    🗑 Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">
                            No marketing sources found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $sources->links() }}
    </div>
</x-layout>
