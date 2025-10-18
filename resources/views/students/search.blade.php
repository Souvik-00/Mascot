<x-layout title="Search Students">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>🔍 Search Results (Students)</h3>
        <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">⬅ Back</a>
    </div>

    <form method="GET" action="{{ route('students.search') }}" class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search again...">
        </div>
        <div class="col-md-2">
            <button class="btn btn-secondary w-100">Search</button>
        </div>
    </form>

    @if($students->isEmpty())
        <div class="alert alert-warning">No students found for “{{ $query }}”.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone ?? '—' }}</td>
                            <td>{{ ucfirst($student->status) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-layout>
