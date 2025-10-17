<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">🔍 Search Teachers</h4>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">← Back</a>
    </div>

    <form method="GET" action="{{ route('teachers.search') }}" class="card shadow-sm border-0 mb-4">
        <div class="card-body row g-3 align-items-end">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Search</label>
                <input type="text" name="search" class="form-control"
                       placeholder="Search by name or code..." value="{{ request('search') }}">
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select">
                    <option value="">All</option>
                    @foreach(['active','inactive'] as $status)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 text-end">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Search</button>
            </div>
        </div>
    </form>

    <div class="card border-0 shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Joined On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teachers as $teacher)
                        <tr>
                            <td>{{ $teacher->teacher_code }}</td>
                            <td>{{ $teacher->first_name }} {{ $teacher->last_name }}</td>
                            <td>{{ $teacher->email ?? '—' }}</td>
                            <td>{{ $teacher->phone ?? '—' }}</td>
                            <td>
                                <span class="badge bg-{{ $teacher->status === 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($teacher->status) }}
                                </span>
                            </td>
                            <td>{{ $teacher->joined_on ? $teacher->joined_on->format('Y-m-d') : '—' }}</td>
                            <td>
                                <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this teacher?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">No teachers found.</td></tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $teachers->links() }}
            </div>
        </div>
    </div>
</x-layout>
