<x-layout>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Add Expense Category</h4>
            <a href="{{ route('expense_category.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('expense_category.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Category Name</label>
                        <input type="text" name="category_name" value="{{ old('category_name') }}"
                               class="form-control @error('category_name') is-invalid @enderror"
                               placeholder="Enter expense category name" required>
                        @error('category_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Save Category
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
