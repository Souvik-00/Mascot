<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Schedules</h3>
        <a href="{{ route('schedules.create') }}" class="btn btn-primary">Add Schedule</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Date</th><th>Start</th><th>End</th><th>Batch</th><th>Session</th><th>Teacher</th><th>Room</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->id }}</td>
                    <td>{{ $schedule->scheduled_date }}</td>
                    <td>{{ $schedule->start_time }}</td>
                    <td>{{ $schedule->end_time }}</td>
                    <td>{{ $schedule->batch?->name }}</td>
                    <td>{{ $schedule->classSession?->topic }}</td>
                    <td>{{ $schedule->teacher?->name }}</td>
                    <td>{{ $schedule->room }}</td>
                    <td>
                        <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this schedule?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="9" class="text-center">No schedules found.</td></tr>
            @endforelse
        </tbody>
    </table>
</x-layout>
