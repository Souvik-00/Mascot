<x-layout>
    <h3>Edit Classroom</h3>

    <form method="POST" action="{{ route('classrooms.update', $classroom->id) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Organisation</label>
                <select name="organisation_id" class="form-control" required>
                    @foreach($organisations as $org)
                        <option value="{{ $org->id }}" {{ $classroom->organisation_id == $org->id ? 'selected' : '' }}>
                            {{ $org->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Batch</label>
                <select name="batch_id" class="form-control">
                    <option value="">Select Batch</option>
                    @foreach($batches as $batch)
                        <option value="{{ $batch->id }}" {{ $classroom->batch_id == $batch->id ? 'selected' : '' }}>
                            {{ $batch->title }} ({{ $batch->batch_code }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Class Code</label>
                <input type="text" name="class_code" class="form-control" value="{{ $classroom->class_code }}" required>
            </div>
            <div class="col-md-8 mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ $classroom->title }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3">{{ $classroom->description }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Duration (hrs)</label>
                <input type="number" name="duration_hours" class="form-control" value="{{ $classroom->duration_hours }}">
            </div>
            <div class="col-md-6 mb-3">
                <label>Max Students</label>
                <input type="number" name="max_students" class="form-control" value="{{ $classroom->max_students }}">
            </div>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('classrooms.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-layout>
