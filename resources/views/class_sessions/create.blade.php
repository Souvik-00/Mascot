<x-layout>
    <h3>Add Class Session</h3>

    <form method="POST" action="{{ route('class-sessions.store') }}">
        @csrf

        <div class="mb-3">
            <label>Organisation</label>
            <select name="organisation_id" class="form-control" required>
                <option value="">Select Organisation</option>
                @foreach($organisations as $org)
                    <option value="{{ $org->id }}">{{ $org->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Classroom</label>
            <select name="classroom_id" class="form-control" required>
                <option value="">Select Classroom</option>
                @foreach($classrooms as $class)
                    <option value="{{ $class->id }}">{{ $class->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Teacher (optional)</label>
            <select name="teacher_id" class="form-control">
                <option value="">Select Teacher</option>
                @foreach($teachers as $t)
                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Topic</label>
            <input type="text" name="topic" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="session_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Start Time</label>
            <input type="time" name="start_time" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>End Time</label>
            <input type="time" name="end_time" class="form-control">
        </div>

        <div class="mb-3">
            <label>Notes</label>
            <textarea name="notes" class="form-control"></textarea>
        </div>

        <button class="btn btn-success">Save</button>
        <a href="{{ route('class-sessions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-layout>
