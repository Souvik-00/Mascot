<x-layout title="Teachers">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>👨‍🏫 All Teachers</h3>
        <form method="GET" action="{{ route('teachers.search') }}" class="d-flex">
            <input type="text" name="q" class="form-control me-2" placeholder="Search teachers...">
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
                @forelse($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->id }}</td>
                        <td>{{ $teacher->first_name }} {{ $teacher->last_name }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->phone ?? '—' }}</td>
                        <td>
                            <span class="badge bg-{{ $teacher->status == 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($teacher->status) }}
                            </span>
                        </td>
                        <td>{{ $teacher->joined_at ?? '—' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted">No teachers found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $teachers->links() }}
</x-layout>
