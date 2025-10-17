<x-layout>
    <h3>Edit Schedule</h3>

    <form method="POST" action="{{ route('schedules.update', $schedule->id) }}">
        @csrf
        @method('PUT')

        {{-- <!-- Organisation -->
        <div class="mb-3">
            <label>Organisation</label>
            <select name="organisation_id" class="form-control" required>
                @foreach($organisations as $org)
                    <option value="{{ $org->id }}" {{ $schedule->organisation_id == $org->id ? 'selected' : '' }}>
                        {{ $org->name }}
                    </option>
                @endforeach
            </select>
        </div> --}}

        <!-- Batch -->
        <div class="mb-3">
            <label>Batch</label>
            <select name="batch_id" class="form-control">
                <option value="">Select Batch</option>
                @foreach($batches as $batch)
                    <option value="{{ $batch->id }}" {{ $schedule->batch_id == $batch->id ? 'selected' : '' }}>
                        {{ $batch->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Class Session -->
        <div class="mb-3">
            <label>Class Session</label>
            <select name="class_session_id" class="form-control">
                <option value="">Select Session</option>
                @foreach($sessions as $session)
                    <option value="{{ $session->id }}" {{ $schedule->class_session_id == $session->id ? 'selected' : '' }}>
                        {{ $session->topic }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Teacher -->
        <div class="mb-3">
            <label>Teacher</label>
            <select name="teacher_id" class="form-control">
                <option value="">Select Teacher</option>
                @foreach($teachers as $t)
                    <option value="{{ $t->id }}" {{ $schedule->teacher_id == $t->id ? 'selected' : '' }}>
                        {{ $t->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Date and Time -->
        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Date</label>
                <input type="date" name="scheduled_date" value="{{ $schedule->scheduled_date }}" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>Start Time</label>
                <input type="time" name="start_time" value="{{ $schedule->start_time }}" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>End Time</label>
                <input type="time" name="end_time" value="{{ $schedule->end_time }}" class="form-control">
            </div>
        </div>

        <!-- Room -->
        <div class="mb-3">
            <label>Room</label>
            <input type="text" name="room" value="{{ $schedule->room }}" class="form-control">
        </div>

        <!-- Notes -->
        <div class="mb-3">
            <label>Notes</label>
            <textarea name="notes" class="form-control" rows="3">{{ $schedule->notes }}</textarea>
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-between">
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('schedules.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</x-layout>
