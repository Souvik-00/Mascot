<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Expenses</h3>
        <a href="{{ route('expenses.create') }}" class="btn btn-primary">Add Expense</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Category</th><th>Amount</th><th>Date</th><th>Payment Method</th><th>Batch</th><th>Organisation</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($expenses as $expense)
                <tr>
                    <td>{{ $expense->id }}</td>
                    <td>{{ $expense->category }}</td>
                    <td>₹{{ number_format($expense->amount, 2) }}</td>
                    <td>{{ $expense->expense_date }}</td>
                    <td>{{ $expense->payment_method ?? '-' }}</td>
                    <td>{{ $expense->batch?->name ?? '-' }}</td>
                    <td>{{ $expense->organisation?->name }}</td>
                    <td>
                        <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this expense?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center">No expenses found.</td></tr>
            @endforelse
        </tbody>
    </table>
</x-layout>
