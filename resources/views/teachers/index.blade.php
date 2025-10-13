<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Teachers Directory (All Fields)</h3>
        <a href="{{ route('teachers.create') }}" class="btn btn-primary">➕ Add Teacher</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive" style="max-height: 75vh; overflow-y: auto;">
        <table class="table table-bordered table-striped table-hover align-middle table-sm">
            <thead class="table-dark text-nowrap">
                <tr>
                    <th>Org</th>
                    <th>Code</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Father</th>
                    <th>Mother</th>
                    <th>Marital Status</th>
                    <th>Spouse</th>
                    <th>Current Address</th>
                    <th>Permanent Address</th>
                    <th>Voter ID</th>
                    <th>PAN</th>
                    <th>Aadhaar</th>
                    <th>Qualification</th>
                    <th>Specialization</th>
                    <th>Joined On</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->organisation?->name ?? '-' }}</td>
                        <td>{{ $teacher->teacher_code }}</td>
                        <td>{{ $teacher->first_name }}</td>
                        <td>{{ $teacher->last_name }}</td>
                        <td>{{ $teacher->email ?? '-' }}</td>
                        <td>{{ $teacher->phone ?? '-' }}</td>
                        <td>{{ $teacher->dob ?? '-' }}</td>
                        <td>{{ ucfirst($teacher->gender ?? '-') }}</td>
                        <td>{{ $teacher->father_name ?? '-' }}</td>
                        <td>{{ $teacher->mother_name ?? '-' }}</td>
                        <td>{{ ucfirst($teacher->marital_status ?? '-') }}</td>
                        <td>{{ $teacher->spouse_name ?? '-' }}</td>
                        <td>{{ $teacher->current_address ?? '-' }}</td>
                        <td>{{ $teacher->permanent_address ?? '-' }}</td>
                        <td>{{ $teacher->voter_id_card_no ?? '-' }}</td>
                        <td>{{ $teacher->pan_card_no ?? '-' }}</td>
                        <td>{{ $teacher->aadhar_no ?? '-' }}</td>
                        <td>{{ ucfirst(str_replace('_',' ', $teacher->highest_qualification ?? '-')) }}</td>
                        <td>{{ $teacher->specialization ?? '-' }}</td>
                        <td>{{ $teacher->joined_on ?? '-' }}</td>
                        <td>
                            <span class="badge bg-{{ $teacher->status == 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($teacher->status) }}
                            </span>
                        </td>
                        <td class="text-nowrap">
                            <a href="{{ route('teachers.show', $teacher->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this teacher?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="22" class="text-center">No teachers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layout>
