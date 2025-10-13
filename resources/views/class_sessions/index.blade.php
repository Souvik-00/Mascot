<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Class Sessions</h3>
        <a href="{{ route('class-sessions.create') }}" class="btn btn-primary">Add Session</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Topic</th><th>Date</th><th>Start</th><th>End</th><th>Teacher</th><th>Classroom</th><th>Organisation</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sessions as $session)
                <tr>
                    <td>{{ $session->id }}</td>
                    <td>{{ $session->topic }}</td>
                    <td>{{ $session->session_date }}</td>
                    <td>{{ $session->start_time }}</td>
                    <td>{{ $session->end_time }}</td>
                    <td>{{ $session->teacher?->name }}</td>
                    <td>{{ $session->classroom?->title }}</td>
                    <td>{{ $session->organisation?->name }}</td>
                    <td>
                        <a href="{{ route('class-sessions.edit', $session->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('class-sessions.destroy', $session->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this session?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="9" class="text-center">No sessions found.</td></tr>
            @endforelse
        </tbody>
    </table>
</x-layout>
