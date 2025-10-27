<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">📚 Course Directory</h4>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">➕ Add New Course</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
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
                        <th>Class Code</th>
                        <th>Department</th>
                        <th>Title</th>
                        <th>Duration (hrs)</th>
                        <th>Max Students</th>
                        <th>Status</th>
                        <th class="text-center" width="160">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($courses as $index => $course)
                        <tr>
                            <td>{{ $index + $courses->firstItem() }}</td>
                            <td><span class="fw-semibold">{{ $course->class_code }}</span></td>
                            <td>{{ $course->department->dept_name ?? '—' }}</td>
                            <td>{{ $course->title }}</td>
                            <td>{{ $course->duration_hours ?? '—' }}</td>
                            <td>{{ $course->max_students ?? '—' }}</td>
                            <td>
                                <span class="badge bg-{{ $course->status === 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($course->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Are you sure you want to delete this course?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-3">No courses found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $courses->links() }}
            </div>
        </div>
    </div>
</x-layout>
