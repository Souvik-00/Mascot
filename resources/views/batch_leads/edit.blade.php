<x-layout>
    <div class="container mt-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Edit Lead Assignment</h4>
            <a href="{{ route('batch_leads.index') }}" class="btn btn-secondary">
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

        {{-- Edit Form --}}
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('batch_leads.update', $assignment->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        {{-- Batch Dropdown --}}
                        <div class="col-md-6">
                            <label class="form-label">Select Batch</label>
                            <select name="batch_id" class="form-select" required>
                                <option value="">-- Choose Batch --</option>
                                @foreach($batches as $batch)
                                    <option value="{{ $batch->id }}"
                                        {{ $assignment->batch_id == $batch->id ? 'selected' : '' }}>
                                        {{ $batch->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Lead Dropdown --}}
                        <div class="col-md-6">
                            <label class="form-label">Select Lead</label>
                            <select name="lead_id" class="form-select" required>
                                <option value="">-- Choose Lead --</option>
                                @foreach($leads as $lead)
                                    <option value="{{ $lead->id }}"
                                        {{ $assignment->lead_id == $lead->id ? 'selected' : '' }}>
                                        {{ $lead->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="{{ route('batch_leads.index') }}" class="btn btn-outline-secondary">
                        Cancel
                    </a>
                </form>
            </div>
        </div>

    </div>
</x-layout>
