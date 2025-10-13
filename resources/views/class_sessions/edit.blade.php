<x-layout>
    <h3>Edit Class Session</h3>

    <form method="POST" action="{{ route('class-sessions.update', $class_session->id) }}">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Organisation</label>
            <select name="organisation_id" class="form-control" required>
                @foreach($organisations as $org)
                    <option value="{{ $org->id }}" {{ $class_session->organisation_id == $org->id ? 'selected' : '' }}>
                        {{ $org->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Classroom</label>
            <select name="classroom_id" class="form-control" required>
                @foreach($classrooms as $class)
                    <option value="{{ $class->id }}" {{ $class_session->classroom_id == $class->id ? 'selected' : '' }}>
                        {{ $class->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Teacher (optional)</label>
            <select name="teacher_id" class="form-control">
                <option value="">Select Teacher</option>
                @foreach($teachers as $t)
                    <option value="{{ $t->id }}" {{ $class_session->teacher_id == $t->id ? 'selected' : '' }}>
                        {{ $t->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Topic</label>
            <input type="text" name="topic" value="{{ $class_session->topic }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="session_date" value="{{ $class_session->session_date }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Start Time</label>
            <input type="time" name="start_time" value="{{ $class_session->start_time }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>End Time</label>
            <input type="time" name="end_time" value="{{ $class_session->end_time }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Notes</label>
            <textarea name="notes" class="form-control">{{ $class_session->notes }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('class-sessions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-layout>
