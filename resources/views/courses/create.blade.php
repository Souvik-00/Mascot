<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">➕ Add New Course</h4>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">← Back</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('courses.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Class Code *</label>
                    <input type="text" name="class_code" class="form-control" placeholder="CR-001" value="{{ old('class_code') }}">
                    @error('class_code') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Title *</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Duration (hrs)</label>
                        <input type="number" name="duration_hours" class="form-control" value="{{ old('duration_hours') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Max Students</label>
                        <input type="number" name="max_students" class="form-control" value="{{ old('max_students') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Status *</label>
                    <select name="status" class="form-select">
                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="text-end">
                    <button class="btn btn-primary px-4">💾 Save Course</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
