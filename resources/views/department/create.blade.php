<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">➕ Add New Department</h4>
        <a href="{{ route('department.index') }}" class="btn btn-secondary">← Back</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('department.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Department Name *</label>
                    <input type="text" name="dept_name" class="form-control" value="{{ old('dept_name') }}" placeholder="e.g. Human Resource">
                    @error('dept_name') 
                        <small class="text-danger">{{ $message }}</small> 
                    @enderror
                </div>

                <div class="text-end">
                    <button class="btn btn-primary px-4">💾 Save</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
