<x-layout title="Student Details">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5>🎓 Student Details</h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr><th>Student Code:</th><td>{{ $student->student_code }}</td></tr>
                <tr><th>Full Name:</th><td>{{ $student->first_name }} {{ $student->last_name }}</td></tr>
                <tr><th>Email:</th><td>{{ $student->email ?? '—' }}</td></tr>
                <tr><th>Phone:</th><td>{{ $student->phone ?? '—' }}</td></tr>
                <tr><th>Date of Birth:</th><td>{{ $student->dob ?? '—' }}</td></tr>
                <tr><th>Gender:</th><td>{{ ucfirst($student->gender ?? '—') }}</td></tr>
                <tr><th>Organisation:</th><td>{{ $student->organisation?->name ?? '—' }}</td></tr>
                <tr><th>Status:</th>
                    <td>
                        <span class="badge bg-{{ $student->status == 'active' ? 'success' : ($student->status == 'inactive' ? 'secondary' : 'warning') }}">
                            {{ ucfirst($student->status) }}
                        </span>
                    </td>
                </tr>
            </table>

            <div class="mt-3">
                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">✏️ Edit</a>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">⬅️ Back</a>
            </div>
        </div>
    </div>
</x-layout>
