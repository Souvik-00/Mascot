<x-layout title="Edit Course">
    <h3 class="mb-4">✏️ Edit Course</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('courses.update', $course->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Organisation</label>
            <select name="organisation_id" class="form-control" required>
                <option value="">Select Organisation</option>
                @foreach($organisations as $org)
                    <option value="{{ $org->id }}"
                        {{ old('organisation_id', $course->organisation_id) == $org->id ? 'selected' : '' }}>
                        {{ $org->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Class Code</label>
            <input type="text" name="class_code" class="form-control"
                   value="{{ old('class_code', $course->class_code) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control"
                   value="{{ old('title', $course->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $course->description) }}</textarea>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Duration (hrs)</label>
                <input type="number" name="duration_hours" class="form-control"
                       value="{{ old('duration_hours', $course->duration_hours) }}">
            </div>
            <div class="col">
                <label class="form-label">Max Students</label>
                <input type="number" name="max_students" class="form-control"
                       value="{{ old('max_students', $course->max_students) }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                @foreach (['active' => 'Active', 'inactive' => 'Inactive'] as $val => $label)
                    <option value="{{ $val }}" {{ old('status', $course->status) === $val ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</x-layout>
