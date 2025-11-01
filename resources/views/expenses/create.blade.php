<x-layout>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Add Expense</h4>
            <a href="{{ route('expenses.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('expenses.store') }}">
                    @csrf

                    {{-- Category --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Category</label>
                        <select id="categorySelect" name="category_id" class="form-select" required>
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Subcategory --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Subcategory</label>
                        <select name="subcategory_id" id="subcategorySelect" class="form-select" required>
                            <option value="">-- Select Subcategory --</option>
                        </select>
                    </div>

                    {{-- Amount --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Amount (₹)</label>
                        <input type="number" name="amount" step="0.01" value="{{ old('amount') }}" class="form-control" required>
                    </div>

                    {{-- Expense Date --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Expense Date</label>
                        <input type="date" name="expense_date" value="{{ old('expense_date') ?? now()->toDateString() }}" class="form-control" required>
                    </div>

                    {{-- Payment Method --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Payment Method</label>
                        <select name="payment_method" class="form-select">
                            <option value="">-- Select Payment Method --</option>
                            <option value="Cash">Cash</option>
                            <option value="Credit Card">Credit Card</option>
                            <option value="UPI">UPI</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                        </select>
                    </div>

                    {{-- Notes --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Notes</label>
                        <textarea name="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Save Expense
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- AJAX Subcategory Loader --}}
    <script>
        document.getElementById('categorySelect').addEventListener('change', function () {
            const categoryId = this.value;
            const subcategorySelect = document.getElementById('subcategorySelect');
            subcategorySelect.innerHTML = '<option value="">Loading...</option>';

            if (categoryId) {
                fetch(`/get-subcategories/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        subcategorySelect.innerHTML = '<option value="">-- Select Subcategory --</option>';
                        data.forEach(subcat => {
                            const opt = document.createElement('option');
                            opt.value = subcat.id;
                            opt.textContent = subcat.sub_category_name;
                            subcategorySelect.appendChild(opt);
                        });
                    })
                    .catch(() => {
                        subcategorySelect.innerHTML = '<option value="">Error loading subcategories</option>';
                    });
            } else {
                subcategorySelect.innerHTML = '<option value="">-- Select Subcategory --</option>';
            }
        });
    </script>
</x-layout>
