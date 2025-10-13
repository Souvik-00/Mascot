<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Payments</h3>
        <a href="{{ route('payments.create') }}" class="btn btn-primary">Add Payment</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Student</th><th>Batch</th><th>Amount</th><th>Method</th><th>Date</th><th>Transaction ID</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->student?->name }}</td>
                    <td>{{ $payment->batch?->name }}</td>
                    <td>₹{{ number_format($payment->amount, 2) }}</td>
                    <td>{{ $payment->payment_method ?? 'N/A' }}</td>
                    <td>{{ $payment->payment_date }}</td>
                    <td>{{ $payment->transaction_id ?? '-' }}</td>
                    <td>
                        <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this payment?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center">No payments found.</td></tr>
            @endforelse
        </tbody>
    </table>
</x-layout>
