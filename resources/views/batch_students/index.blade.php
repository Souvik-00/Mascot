<x-layout>

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">🎓 Manage Students for Batch</h4>
        <a href="{{ route('batches.index') }}" class="btn btn-secondary">← Back to Batches</a>
    </div>

    {{-- Batch Info --}}
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

    {{-- Add Student Form --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('batch_students.store', $batch->id) }}" method="POST" class="row g-2 align-items-end">
                @csrf

                <div class="col-md-8">
                    <label class="form-label fw-semibold">Select Student</label>
                    <select name="student_id" class="form-select" required>
                        <option value="">-- Choose Student --</option>
                        @foreach($students as $stu)
                            <option value="{{ $stu->id }}">{{ $stu->first_name }} {{ $stu->last_name }}</option>
                        @endforeach
                    </select>
                    @error('student_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4">
                    <button class="btn btn-primary w-100">➕ Add Student</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Assigned Students Table --}}
    <div class="card shadow-sm border-0">
        <div class="card-body table-responsive">
            <h5 class="fw-bold mb-3">📍 Assigned Students ({{ count($assignedStudents) }})</h5>

            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assignedStudents as $index => $as)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $as->student->first_name }} {{ $as->student->last_name }}</td>
                            <td class="text-end">
                                <form action="{{ route('batch.students.destroy', [$batch->id, $as->student_id]) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Remove this student from the batch?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-3">
                                No students assigned to this batch yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-layout>
