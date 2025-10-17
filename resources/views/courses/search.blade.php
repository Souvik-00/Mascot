<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">🔍 Search Courses</h4>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">← Back</a>
    </div>

    <form method="GET" action="{{ route('courses.search') }}" class="card p-3 mb-4 shadow-sm">
        <div class="row">
            <div class="col-md-5 mb-2">
                <input type="text" name="search" class="form-control"
                       value="{{ request('search') }}" placeholder="Search by code or title">
            </div>
            <div class="col-md-4 mb-2">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-md-3 mb-2">
                <button class="btn btn-primary w-100">Search</button>
            </div>
        </div>
    </form>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Class Code</th>
                        <th>Title</th>
                        <th>Duration (hrs)</th>
                        <th>Max Students</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($courses as $index => $course)
                        <tr>
                            <td>{{ $index + $courses->firstItem() }}</td>
                            <td>{{ $course->class_code }}</td>
                            <td>{{ $course->title }}</td>
                            <td>{{ $course->duration_hours ?? '—' }}</td>
                            <td>{{ $course->max_students ?? '—' }}</td>
                            <td>
                                <span class="badge bg-{{ $course->status === 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($course->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">No courses found.</td>
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
