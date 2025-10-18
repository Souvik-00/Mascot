<x-layout title="Students">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>🧑‍🎓 All Students</h3>
        <form method="GET" action="{{ route('students.search') }}" class="d-flex">
            <input type="text" name="q" class="form-control me-2" placeholder="Search students...">
            <button type="submit" class="btn btn-secondary">Search</button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Joined</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->phone ?? '—' }}</td>
                        <td>
                            <span class="badge bg-{{ $student->status == 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($student->status) }}
                            </span>
                        </td>
                        <td>{{ $student->joined_at ?? '—' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted">No students found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $students->links() }}
</x-layout>
