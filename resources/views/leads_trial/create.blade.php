<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">🧪 Add Lead Trial</h4>
        <a href="{{ route('leads_trial.index') }}" class="btn btn-secondary">← Back</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('leads_trial.store') }}" method="POST">
                @csrf

                {{-- Lead --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Lead Name *</label>
                    <input type="text" class="form-control" value="{{ $lead->name }}" disabled>
                    <input type="hidden" name="leads_id" value="{{ $lead->id }}">
                </div>

                {{-- Trial Start Date --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Trial Start Date *</label>
                    <input type="date" name="trl_start_dt" id="startDate" class="form-control" value="{{ old('trl_start_dt') }}" required>
                    @error('trl_start_dt') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Trial End Date (Auto) --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Trial End Date (Auto Calculated)</label>
                    <input type="date" id="endDate" class="form-control" readonly>
                </div>

                {{-- Course --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Course *</label>
                    <select name="course_id" class="form-select" required>
                        <option value="">Select Course</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                {{ $course->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('course_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Batch --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Batch *</label>
                    <select name="batch_id" class="form-select" required>
                        <option value="">Select Batch</option>
                        @foreach ($batches as $batch)
                            <option value="{{ $batch->id }}" {{ old('batch_id') == $batch->id ? 'selected' : '' }}>
                                {{ $batch->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('batch_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Comments --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Comments *</label>
                    <textarea name="comments" class="form-control" rows="3" required>{{ old('comments') }}</textarea>
                    @error('comments') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="text-end">
                    <button class="btn btn-primary px-4">💾 Save Trial</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Auto Calculate End Date based on Start Date --}}
    <script>
        document.getElementById('startDate').addEventListener('change', function () {
            let start = new Date(this.value);
            if (!isNaN(start.getTime())) {
                start.setMonth(start.getMonth() + 1);
                document.getElementById('endDate').value = start.toISOString().slice(0, 10);
            }
        });
    </script>
</x-layout>
