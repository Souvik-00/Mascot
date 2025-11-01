<x-layout>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Edit Expense</h4>
            <a href="{{ route('expenses.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('expenses.update', $expense->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- Category --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Category</label>
                        <select id="categorySelect" name="category_id" class="form-select" required>
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $expense->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Subcategory --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Subcategory</label>
                        <select name="subcategory_id" id="subcategorySelect" class="form-select" required>
                            @foreach($subcategories as $subcat)
                                <option value="{{ $subcat->id }}" {{ $expense->subcategory_id == $subcat->id ? 'selected' : '' }}>
                                    {{ $subcat->sub_category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Amount --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Amount (₹)</label>
                        <input type="number" name="amount" step="0.01" value="{{ $expense->amount }}" class="form-control" required>
                    </div>

                    {{-- Expense Date --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Expense Date</label>
                        <input type="date" name="expense_date" value="{{ $expense->expense_date }}" class="form-control" required>
                    </div>

                    {{-- Payment Method --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Payment Method</label>
                        <select name="payment_method" class="form-select">
                            <option value="">-- Select Payment Method --</option>
                            <option value="Cash" {{ $expense->payment_method == 'Cash' ? 'selected' : '' }}>Cash</option>
                            <option value="Credit Card" {{ $expense->payment_method == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                            <option value="UPI" {{ $expense->payment_method == 'UPI' ? 'selected' : '' }}>UPI</option>
                            <option value="Bank Transfer" {{ $expense->payment_method == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        </select>
                    </div>

                    {{-- Notes --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Notes</label>
                        <textarea name="notes" class="form-control" rows="3">{{ $expense->notes }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Update Expense
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
