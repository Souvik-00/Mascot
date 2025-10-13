<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Students Directory</h3>
        <a href="{{ route('students.create') }}" class="btn btn-primary">➕ Add Student</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive" style="max-height:75vh; overflow-y:auto;">
        <table class="table table-bordered table-striped table-hover align-middle table-sm">
            <thead class="table-dark text-nowrap">
                <tr>
                    <th>Org</th><th>Code</th><th>First</th><th>Last</th><th>Email</th><th>Phone</th><th>DOB</th>
                    <th>Gender</th><th>Father</th><th>Mother</th><th>Marital</th><th>Spouse</th>
                    <th>Current Address</th><th>Permanent Address</th><th>Voter ID</th><th>PAN</th><th>Aadhaar</th>
                    <th>Qualification</th><th>Joined On</th><th>Status</th><th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td>{{ $student->organisation?->name ?? '-' }}</td>
                        <td>{{ $student->student_code }}</td>
                        <td>{{ $student->first_name }}</td>
                        <td>{{ $student->last_name }}</td>
                        <td>{{ $student->email ?? '-' }}</td>
                        <td>{{ $student->phone ?? '-' }}</td>
                        <td>{{ $student->dob ?? '-' }}</td>
                        <td>{{ ucfirst($student->gender ?? '-') }}</td>
                        <td>{{ $student->father_name ?? '-' }}</td>
                        <td>{{ $student->mother_name ?? '-' }}</td>
                        <td>{{ ucfirst($student->marital_status ?? '-') }}</td>
                        <td>{{ $student->spouse_name ?? '-' }}</td>
                        <td>{{ $student->current_address ?? '-' }}</td>
                        <td>{{ $student->permanent_address ?? '-' }}</td>
                        <td>{{ $student->voter_id_card_no ?? '-' }}</td>
                        <td>{{ $student->pan_card_no ?? '-' }}</td>
                        <td>{{ $student->aadhar_no ?? '-' }}</td>
                        <td>{{ ucfirst(str_replace('_',' ', $student->highest_qualification ?? '-')) }}</td>
                        <td>{{ $student->joined_on ?? '-' }}</td>
                        <td>
                            <span class="badge bg-{{ $student->status == 'active' ? 'success' : ($student->status == 'alumni' ? 'info' : 'secondary') }}">
                                {{ ucfirst($student->status) }}
                            </span>
                        </td>
                        <td class="text-nowrap">
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this student?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="21" class="text-center">No students found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layout>
