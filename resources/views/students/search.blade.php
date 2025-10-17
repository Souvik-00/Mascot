<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">🔍 Search Students</h4>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">← Back</a>
    </div>

    <!-- Search Filter -->
    <form method="GET" action="{{ route('students.search') }}" class="card shadow-sm border-0 mb-4">
        <div class="card-body row g-3 align-items-end">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Search</label>
                <input type="text" name="search" class="form-control"
                       placeholder="Search by name or student code..." value="{{ request('search') }}">
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select">
                    <option value="">All</option>
                    @foreach(['active','inactive','lead','alumni','withdrawn'] as $status)
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

    <!-- Search Results -->
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr>
                            <td>{{ $student->student_code }}</td>
                            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                            <td>{{ $student->email ?? '—' }}</td>
                            <td>{{ $student->phone ?? '—' }}</td>
                            <td>
                                @php
                                    $colors = [
                                        'active' => 'success',
                                        'inactive' => 'secondary',
                                        'lead' => 'warning',
                                        'alumni' => 'info',
                                        'withdrawn' => 'danger'
                                    ];
                                @endphp
                                <span class="badge bg-{{ $colors[$student->status] ?? 'secondary' }}">
                                    {{ ucfirst($student->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this student?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No matching students found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $students->links() }}
            </div>
        </div>
    </div>
</x-layout>
