<x-layout title="Search Students">
    <h3>🔍 Search Students</h3>

    <form method="GET" action="{{ route('students.search') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="query" class="form-control"
                   placeholder="Search by name, email, or code..."
                   value="{{ $query }}">
            <button class="btn btn-primary">Search</button>
        </div>
    </form>

    @if ($students->count())
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
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->student_code }}</td>
                            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                            <td>{{ $student->email ?? '—' }}</td>
                            <td>{{ $student->phone ?? '—' }}</td>
                            <td>{{ $student->organisation?->name ?? '—' }}</td>
                            <td>
                                <span class="badge bg-{{ $student->status == 'active' ? 'success' : ($student->status == 'inactive' ? 'secondary' : 'warning') }}">
                                    {{ ucfirst($student->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                                <form method="POST" action="{{ route('students.destroy', $student->id) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this student?')">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $students->links() }}
    @else
        <p class="text-muted">No students found. Try searching with different keywords.</p>
    @endif
</x-layout>
