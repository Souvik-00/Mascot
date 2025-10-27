<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">✏️ Edit Batch — {{ $batch->batch_code }}</h4>
        <a href="{{ route('batches.index') }}" class="btn btn-secondary">← Back</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form method="POST" action="{{ route('batches.update', $batch->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Batch Code *</label>
                    <input type="text" name="batch_code" class="form-control" value="{{ old('batch_code', $batch->batch_code) }}">
                    @error('batch_code') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Assign Course</label>
                    <select name="course_id" class="form-select">
                        <option value="">-- Select Course --</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" 
                        {{ (old('lead_id') ?? $batch->course_id) == $course->id ? 'selected' : '' }}>
                        {{ $course->title }}
                        </option>
                    @endforeach
                    </select>
                    @error('course_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Title *</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $batch->title) }}">
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Start Date *</label>
                        <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $batch->start_date) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">End Date</label>
                        <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $batch->end_date) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Capacity</label>
                    <input type="number" name="capacity" class="form-control" value="{{ old('capacity', $batch->capacity) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Status *</label>
                    <select name="status" class="form-select">
                        @foreach(['planned','running','completed','cancelled'] as $status)
                            <option value="{{ $status }}" {{ old('status', $batch->status) === $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="text-end">
                    <button class="btn btn-primary px-4">💾 Update Batch</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
