<x-layout>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Edit Payment</h4>
            <a href="{{ route('payments.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('payments.update', $payment->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Student --}}
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Student</label>
                            <select id="studentSelect" name="student_id" class="form-select" required>
                                <option value="">-- Select Student --</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}"
                                        {{ (request('student_id', $payment->student_id) == $student->id) ? 'selected' : '' }}>
                                        {{ $student->first_name }} {{ $student->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Batch --}}
                        <div class="col-md-4">
                            <label class="form-label">Batch</label>
                            <select name="batch_id" class="form-select">
                                <option value="">-- Select Batch --</option>
                                @foreach($batches as $batch)
                                    <option value="{{ $batch->id }}" {{ $batch->id == $payment->batch_id ? 'selected' : '' }}>
                                        {{ $batch->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Payment Date</label>
                            <input type="date" name="payment_date" value="{{ $payment->payment_date }}" class="form-control" required>
                        </div>
                    </div>

                    {{-- Payment details --}}
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Amount (₹)</label>
                            <input type="number" step="0.01" name="amount" value="{{ $payment->amount }}" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Payment Method</label>
                            <select name="payment_method" class="form-select">
                                <option value="">-- Select Method --</option>
                                <option value="Cash" {{ $payment->payment_method == 'Cash' ? 'selected' : '' }}>Cash</option>
                                <option value="Credit Card" {{ $payment->payment_method == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                                <option value="UPI" {{ $payment->payment_method == 'UPI' ? 'selected' : '' }}>UPI</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Transaction ID</label>
                            <input type="text" name="transaction_id" value="{{ $payment->transaction_id }}" class="form-control" placeholder="Optional">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="3" placeholder="Optional">{{ $payment->notes }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update Payment
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- 🧠 Redirect when student changes --}}
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const studentSelect = document.getElementById('studentSelect');
        studentSelect.addEventListener('change', function() {
            const studentId = this.value;
            if (studentId) {
                window.location.href = `{{ url('payments/' . $payment->id . '/edit') }}?student_id=${studentId}`;
            } else {
                window.location.href = `{{ url('payments/' . $payment->id . '/edit') }}`;
            }
        });
    });
    </script>
</x-layout>
