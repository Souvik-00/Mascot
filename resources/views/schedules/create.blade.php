<x-layout>
    <h3>Add Schedule</h3>

    <form method="POST" action="{{ route('schedules.store') }}">
        @csrf

        {{-- <div class="mb-3">
            <label>Organisation</label>
            <select name="organisation_id" class="form-control" required>
                <option value="">Select Organisation</option>
                @foreach($organisations as $org)
                    <option value="{{ $org->id }}">{{ $org->name }}</option>
                @endforeach
            </select>
        </div> --}}

        <div class="mb-3">
            <label>Batch</label>
            <select name="batch_id" class="form-control">
                <option value="">Select Batch</option>
                @foreach($batches as $batch)
                    <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Class Session</label>
            <select name="class_session_id" class="form-control">
                <option value="">Select Session</option>
                @foreach($sessions as $session)
                    <option value="{{ $session->id }}">{{ $session->topic }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Teacher</label>
            <select name="teacher_id" class="form-control">
                <option value="">Select Teacher</option>
                @foreach($teachers as $t)
                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Date</label>
                <input type="date" name="scheduled_date" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>Start Time</label>
                <input type="time" name="start_time" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>End Time</label>
                <input type="time" name="end_time" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label>Room</label>
            <input type="text" name="room" class="form-control">
        </div>

        <div class="mb-3">
            <label>Notes</label>
            <textarea name="notes" class="form-control"></textarea>
        </div>

        <button class="btn btn-success">Save</button>
        <a href="{{ route('schedules.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-layout>
