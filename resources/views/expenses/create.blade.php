<x-layout>
    <h3>Add Expense</h3>

    <form method="POST" action="{{ route('expenses.store') }}">
        @csrf

        <div class="mb-3">
            <label>Organisation</label>
            <select name="organisation_id" class="form-control" required>
                @foreach($organisations as $org)
                    <option value="{{ $org->id }}">{{ $org->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Batch (optional)</label>
            <select name="batch_id" class="form-control">
                <option value="">Select Batch</option>
                @foreach($batches as $batch)
                    <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Category</label>
                <input type="text" name="category" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>Amount</label>
                <input type="number" step="0.01" name="amount" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>Date</label>
                <input type="date" name="expense_date" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Payment Method</label>
            <select name="payment_method" class="form-control">
                <option value="">Select</option>
                <option value="Cash">Cash</option>
                <option value="Card">Card</option>
                <option value="UPI">UPI</option>
                <option value="Bank Transfer">Bank Transfer</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Notes</label>
            <textarea name="notes" class="form-control" rows="3"></textarea>
        </div>

        <button class="btn btn-success">Save</button>
        <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-layout>
