<x-layout title="Search Teachers">
    <h3 class="mb-4">🔍 Search Teachers</h3>

    <form method="GET" action="{{ route('teachers.search') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="query" class="form-control"
                   placeholder="Search by name, email, or teacher code..."
                   value="{{ $query ?? '' }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    @if ($teachers->count())
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Code</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Organisation</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td>{{ $teacher->teacher_code }}</td>
                            <td>{{ $teacher->first_name }} {{ $teacher->last_name }}</td>
                            <td>{{ $teacher->email ?? '—' }}</td>
                            <td>{{ $teacher->phone ?? '—' }}</td>
                            <td>{{ $teacher->organisation?->name ?? '—' }}</td>
                            <td>
                                <span class="badge bg-{{ $teacher->status == 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($teacher->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('teachers.show', $teacher->id) }}" class="btn btn-info btn-sm">👁️ View</a>
                                <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                                <form method="POST" action="{{ route('teachers.destroy', $teacher->id) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this teacher?')">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $teachers->links() }}
        </div>
    @else
        <p class="text-muted">No teachers found. Try searching with another keyword.</p>
    @endif
</x-layout>
