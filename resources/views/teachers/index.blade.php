<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">👩‍🏫 Teacher Directory</h4>
        <a href="{{ route('teachers.create') }}" class="btn btn-primary">
            ➕ Add New Teacher
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
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
                        <th>Teacher Code</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Qualification</th>
                        <th>Joined On</th>
                        <th>Status</th>
                        <th class="text-center" width="160">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($teachers as $index => $teacher)
                        <tr>
                            <td>{{ $index + $teachers->firstItem() }}</td>
                            <td><span class="fw-semibold">{{ $teacher->teacher_code }}</span></td>
                            <td>{{ $teacher->first_name }} {{ $teacher->last_name }}</td>
                            <td>{{ $teacher->email ?? '—' }}</td>
                            <td>{{ $teacher->phone ?? '—' }}</td>
                            <td>{{ ucwords(str_replace('_', ' ', $teacher->highest_qualification ?? '—')) }}</td>
                            <td>
                                {{ $teacher->joined_on ? \Carbon\Carbon::parse($teacher->joined_on)->format('d M Y') : '—' }}
                            </td>
                            <td>
                                <span class="badge bg-{{ $teacher->status === 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($teacher->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this teacher?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-3">
                                No teachers found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $teachers->links() }}
            </div>
        </div>
    </div>
</x-layout>
