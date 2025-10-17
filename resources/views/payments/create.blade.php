<x-layout>
    <h3>Add Payment</h3>

    <form method="POST" action="{{ route('payments.store') }}">
        @csrf

        {{-- <div class="mb-3">
            <label>Organisation</label>
            <select name="organisation_id" class="form-control" required>
                @foreach($organisations as $org)
                    <option value="{{ $org->id }}">{{ $org->name }}</option>
                @endforeach
            </select>
        </div> --}}

        <div class="mb-3">
            <label>Student</label>
            <select name="student_id" class="form-control" required>
                <option value="">Select Student</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Batch</label>
            <select name="batch_id" class="form-control">
                <option value="">Select Batch</option>
                @foreach($batches as $batch)
                    <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Amount</label>
                <input type="number" step="0.01" name="amount" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>Payment Date</label>
                <input type="date" name="payment_date" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>Payment Method</label>
                <select name="payment_method" class="form-control">
                    <option value="">Select</option>
                    <option value="Cash">Cash</option>
                    <option value="Card">Card</option>
                    <option value="UPI">UPI</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label>Transaction ID</label>
            <input type="text" name="transaction_id" class="form-control">
        </div>

        <div class="mb-3">
            <label>Notes</label>
            <textarea name="notes" class="form-control" rows="3"></textarea>
        </div>

        <button class="btn btn-success">Save Payment</button>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-layout>
