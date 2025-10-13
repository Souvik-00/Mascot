<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Classroom Directory</h3>
        <a href="{{ route('classrooms.create') }}" class="btn btn-primary">➕ Add Classroom</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle table-sm">
            <thead class="table-dark text-nowrap">
                <tr>
                    <th>Organisation</th>
                    <th>Batch</th>
                    <th>Class Code</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Duration (hrs)</th>
                    <th>Max Students</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($classrooms as $classroom)
                    <tr>
                        <td>{{ $classroom->organisation?->name ?? '-' }}</td>
                        <td>{{ $classroom->batch?->title ?? '-' }}</td>
                        <td>{{ $classroom->class_code }}</td>
                        <td>{{ $classroom->title }}</td>
                        <td>{{ Str::limit($classroom->description, 40) ?? '-' }}</td>
                        <td>{{ $classroom->duration_hours ?? '-' }}</td>
                        <td>{{ $classroom->max_students ?? '-' }}</td>
                        <td>
                            <a href="{{ route('classrooms.edit', $classroom->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('classrooms.destroy', $classroom->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this classroom?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center">No classrooms found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layout>
