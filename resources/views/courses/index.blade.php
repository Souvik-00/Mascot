<x-layout title="Courses">
    <h3 class="mb-3">📚 Course Directory</h3>
    <a href="{{ route('courses.create') }}" class="btn btn-success mb-3">➕ Add Course</a>

    @if ($courses->count())
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Code</th>
                    <th>Title</th>
                    <th>Organisation</th>
                    <th>Duration</th>
                    <th>Max Students</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td>{{ $course->class_code }}</td>
                        <td>{{ $course->title }}</td>
                        <td>{{ $course->organisation->name ?? '—' }}</td>
                        <td>{{ $course->duration_hours ?? '—' }}</td>
                        <td>{{ $course->max_students ?? '—' }}</td>
                        <td>
                            <span class="badge bg-{{ $course->status == 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($course->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning btn-sm">✏️</a>
                            <form method="POST" action="{{ route('courses.destroy', $course->id) }}" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this course?')">🗑️</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $courses->links() }}
    @else
        <p>No courses found.</p>
    @endif
</x-layout>
