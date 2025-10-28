<x-layout>
    <div class="container mt-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Assign Teacher to Batch</h4>
            <a href="{{ route('batch_teachers.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        {{-- Flash & Validation Messages --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('batch_teachers.store') }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        {{-- Batch Dropdown --}}
                        <div class="col-md-6">
                            <label class="form-label">Select Batch</label>
                            <select name="batches_id" class="form-select" required>
                                <option value="">-- Choose Batch --</option>
                                @foreach($batches as $batch)
                                    <option value="{{ $batch->id }}">{{ $batch->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Teacher Dropdown --}}
                        <div class="col-md-6">
                            <label class="form-label">Select Teacher</label>
                            <select name="teacher_id" class="form-select" required>
                                <option value="">-- Choose Teacher --</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">
                                        {{ trim("{$teacher->first_name} {$teacher->middle_name} {$teacher->last_name}") }} 
                                        ({{ $teacher->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-person-plus"></i> Assign
                    </button>
                    <a href="{{ route('batch_teachers.index') }}" class="btn btn-outline-secondary">
                        Cancel
                    </a>
                </form>
            </div>
        </div>

    </div>
</x-layout>
