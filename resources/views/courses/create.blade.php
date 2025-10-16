<x-layout title="Add Course">
    <h3 class="mb-4">➕ Add New Course</h3>

    <form method="POST" action="{{ route('courses.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Organisation</label>
            <select name="organisation_id" class="form-control" required>
                <option value="">Select Organisation</option>
                @foreach($organisations as $org)
                    <option value="{{ $org->id }}">{{ $org->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Class Code</label>
            <input type="text" name="class_code" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Duration (hrs)</label>
                <input type="number" name="duration_hours" class="form-control">
            </div>
            <div class="col">
                <label class="form-label">Max Students</label>
                <input type="number" name="max_students" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <button class="btn btn-primary w-100">Save</button>
    </form>
</x-layout>
