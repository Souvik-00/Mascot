<x-layout>
    <div class="container mt-4">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Edit Expense</h4>
            <a href="{{ route('expenses.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('expenses.update', $expense->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- Batch --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Batch</label>
                        <select name="batch_id" class="form-select">
                            <option value="">-- Select Batch --</option>
                            @foreach ($batches as $batch)
                                <option value="{{ $batch->id }}"
                                    {{ old('batch_id', $expense->batch_id) == $batch->id ? 'selected' : '' }}>
                                    {{ $batch->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Category --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Category</label>
                        <select name="category_id" id="categorySelect"
                                class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', optional($expense->subcategory)->category_id ?? $expense->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Subcategory --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Subcategory</label>
                        <select name="subcategory_id" id="subcategorySelect"
                                class="form-select @error('subcategory_id') is-invalid @enderror" required>
                            <option value="">-- Select Subcategory --</option>
                            @foreach ($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}"
                                    {{ old('subcategory_id', $expense->subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                                    {{ $subcategory->sub_category_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('subcategory_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Amount --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Amount (₹)</label>
                        <input type="number" name="amount" step="0.01"
                               value="{{ old('amount', $expense->amount) }}"
                               class="form-control @error('amount') is-invalid @enderror" required>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Expense Date --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Expense Date</label>
                        <input type="date" name="expense_date"
                               value="{{ old('expense_date', $expense->expense_date) }}"
                               class="form-control @error('expense_date') is-invalid @enderror" required>
                        @error('expense_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Payment Method --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Payment Method</label>
                        <select name="payment_method" class="form-select">
                            <option value="">-- Select Payment Method --</option>
                            <option value="Cash" {{ old('payment_method', $expense->payment_method) == 'Cash' ? 'selected' : '' }}>Cash</option>
                            <option value="Credit Card" {{ old('payment_method', $expense->payment_method) == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                            <option value="UPI" {{ old('payment_method', $expense->payment_method) == 'UPI' ? 'selected' : '' }}>UPI</option>
                            <option value="Bank Transfer" {{ old('payment_method', $expense->payment_method) == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        </select>
                    </div>

                    {{-- Notes --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Notes</label>
                        <textarea name="notes" class="form-control" rows="3">{{ old('notes', $expense->notes) }}</textarea>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update Expense
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- 🔹 AJAX Script: Load Subcategories Dynamically --}}
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
