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
                <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Batch</label>
                            <select name="batch_id" class="form-select">
                                <option value="">-- Select Batch --</option>
                                @foreach($batches as $batch)
                                    <option value="{{ $batch->id }}" {{ $expense->batch_id == $batch->id ? 'selected' : '' }}>
                                        {{ $batch->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Expense Date</label>
                            <input type="date" name="expense_date" value="{{ $expense->expense_date }}" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Category</label>
                            <input type="text" name="category" value="{{ $expense->category }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Amount (₹)</label>
                            <input type="number" step="0.01" name="amount" value="{{ $expense->amount }}" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Payment Method</label>
                            <select name="payment_method" class="form-select">
                                <option value="">-- Select Method --</option>
                                <option value="Cash" {{ $expense->payment_method == 'Cash' ? 'selected' : '' }}>Cash</option>
                                <option value="Credit Card" {{ $expense->payment_method == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                                <option value="UPI" {{ $expense->payment_method == 'UPI' ? 'selected' : '' }}>UPI</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Notes</label>
                            <input type="text" name="notes" value="{{ $expense->notes }}" class="form-control">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update Expense
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
