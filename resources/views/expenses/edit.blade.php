<x-layout>
    <h3>Edit Expense</h3>

    <form method="POST" action="{{ route('expenses.update', $expense->id) }}">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Organisation</label>
            <select name="organisation_id" class="form-control" required>
                @foreach($organisations as $org)
                    <option value="{{ $org->id }}" {{ $expense->organisation_id == $org->id ? 'selected' : '' }}>
                        {{ $org->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Batch (optional)</label>
            <select name="batch_id" class="form-control">
                <option value="">Select Batch</option>
                @foreach($batches as $batch)
                    <option value="{{ $batch->id }}" {{ $expense->batch_id == $batch->id ? 'selected' : '' }}>
                        {{ $batch->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Category</label>
                <input type="text" name="category" value="{{ $expense->category }}" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>Amount</label>
                <input type="number" step="0.01" name="amount" value="{{ $expense->amount }}" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>Date</label>
                <input type="date" name="expense_date" value="{{ $expense->expense_date }}" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Payment Method</label>
            <select name="payment_method" class="form-control">
                @foreach(['Cash', 'Card', 'UPI', 'Bank Transfer'] as $method)
                    <option value="{{ $method }}" {{ $expense->payment_method == $method ? 'selected' : '' }}>
                        {{ $method }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Notes</label>
            <textarea name="notes" class="form-control" rows="3">{{ $expense->notes }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-layout>
