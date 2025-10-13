<x-layout>
    <h3>Edit Payment</h3>

    <form method="POST" action="{{ route('payments.update', $payment->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Organisation</label>
            <select name="organisation_id" class="form-control" required>
                @foreach($organisations as $org)
                    <option value="{{ $org->id }}" {{ $payment->organisation_id == $org->id ? 'selected' : '' }}>
                        {{ $org->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Student</label>
            <select name="student_id" class="form-control" required>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $payment->student_id == $student->id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Batch</label>
            <select name="batch_id" class="form-control">
                <option value="">Select Batch</option>
                @foreach($batches as $batch)
                    <option value="{{ $batch->id }}" {{ $payment->batch_id == $batch->id ? 'selected' : '' }}>
                        {{ $batch->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Amount</label>
                <input type="number" step="0.01" name="amount" value="{{ $payment->amount }}" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>Payment Date</label>
                <input type="date" name="payment_date" value="{{ $payment->payment_date }}" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label>Payment Method</label>
                <select name="payment_method" class="form-control">
                    <option value="">Select</option>
                    @foreach(['Cash', 'Card', 'UPI', 'Bank Transfer'] as $method)
                        <option value="{{ $method }}" {{ $payment->payment_method == $method ? 'selected' : '' }}>{{ $method }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label>Transaction ID</label>
            <input type="text" name="transaction_id" value="{{ $payment->transaction_id }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Notes</label>
            <textarea name="notes" class="form-control" rows="3">{{ $payment->notes }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-layout>
