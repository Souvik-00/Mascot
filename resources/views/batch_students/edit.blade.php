<x-layout>

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">✏️ Edit Assigned Student</h4>
        <a href="{{ route('batch_students.index', $batch->id) }}" class="btn btn-secondary">← Back</a>
    </div>

    {{-- Batch Summary --}}
    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body">
            <h5 class="fw-bold mb-1">{{ $batch->batch_code }} - {{ $batch->title }}</h5>
            <p class="mb-0">
                <strong>Start:</strong> {{ \Carbon\Carbon::parse($batch->start_date)->format('d M Y') }} &nbsp; | &nbsp;
                <strong>Status:</strong>
                @if($batch->status == 'planned')
                    <span class="badge bg-secondary">Planned</span>
                @elseif($batch->status == 'running')
                    <span class="badge bg-success">Running</span>
                @elseif($batch->status == 'completed')
                    <span class="badge bg-info text-dark">Completed</span>
                @else
                    <span class="badge bg-danger">Cancelled</span>
                @endif
            </p>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Edit Form --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('batch_students.update', [$batch->id, $batchStudent->id]) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Select Student --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Select Student *</label>
                    <select name="student_id" class="form-select" required>
                        <option value="">-- Choose Student --</option>
                        @foreach($students as $stu)
                            <option value="{{ $stu->id }}"
                                {{ old('student_id', $batchStudent->student_id) == $stu->id ? 'selected' : '' }}>
                                {{ $stu->first_name }} {{ $stu->last_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('student_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="text-end">
                    <button class="btn btn-primary px-4">✅ Update Student</button>
                </div>
            </form>
        </div>
    </div>

</x-layout>
