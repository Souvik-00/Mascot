<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">🎓 Student Directory</h4>
        <div>
            <a href="{{ route('students.search') }}" class="btn btn-outline-primary me-2">
                🔍 Advanced Search
            </a>
            <a href="{{ route('students.create') }}" class="btn btn-primary">
                ➕ Add New
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

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
                            <td colspan="6" class="text-center text-muted py-4">No students found.</td>
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
