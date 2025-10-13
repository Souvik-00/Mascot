<x-layout>
    <h3>Add Classroom</h3>

    <form method="POST" action="{{ route('classrooms.store') }}">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Organisation</label>
                <select name="organisation_id" class="form-control" required>
                    <option value="">Select Organisation</option>
                    @foreach($organisations as $org)
                        <option value="{{ $org->id }}">{{ $org->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Batch</label>
                <select name="batch_id" class="form-control">
                    <option value="">Select Batch (optional)</option>
                    @foreach($batches as $batch)
                        <option value="{{ $batch->id }}">{{ $batch->title }} ({{ $batch->batch_code }})</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Class Code</label>
                <input type="text" name="class_code" class="form-control" value="{{ old('class_code') }}" required>
            </div>
            <div class="col-md-8 mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Duration (hrs)</label>
                <input type="number" name="duration_hours" class="form-control" value="{{ old('duration_hours') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label>Max Students</label>
                <input type="number" name="max_students" class="form-control" value="{{ old('max_students') }}">
            </div>
        </div>

        <button class="btn btn-success">Save</button>
        <a href="{{ route('classrooms.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-layout>
